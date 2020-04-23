<?php

namespace App\Http\Controllers\Common;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function __construct() {
      //
   }

   public function buildCategoryTree($elements, $parentId = 0) {
      $branch = array();

      foreach ($elements as $element) {
         if ($element['parent_id'] == $parentId) {

            $children = $this->buildCategoryTree($elements, $element['id']);
            if ($children) {
               $element['children'] = $children;
            }
            $branch[] = $element;
         }
      }

     return $branch;
   }

   public function printCategoryTree($category, $selectedParentId = null, $selfId = null, $html = null, $count = 0) {
      if(!$html && !is_array($selectedParentId)) {
         $html = "<option value='' " .(!$selectedParentId ? 'selected' : null) .">--Select--</option>";
      }
      // Custom Spaces for select
      $space = '';
      for ($i = 0; $i < $count; $i++) { 
         $space .= '&nbsp;&nbsp;&nbsp;';
      }
      if($count !== 0) $space .= '&#8627;&nbsp;';

      foreach ($category as $cat) {

         $selected = null;

         if(is_array($selectedParentId)) {
            if(in_array($cat['id'], $selectedParentId)) $selected = 'selected';

         } elseif($selectedParentId) {
            if($cat['id'] == $selectedParentId) $selected = 'selected';
         }

         if(array_key_exists('children', $cat)){

            $html .= "<option value='{$cat['id']}' " .$selected .($selfId && ($selfId == $cat['id']) ? ' disabled' : null) .">" .$space .$cat['name'] ."</option>";
            // Resetting count if it jumps to next parent
            if(!$cat['parent_id']) $count = 0;

            $html = $this->printCategoryTree($cat['children'], $selectedParentId, $selfId, $html, ++$count);

         }else{
            if(!$cat['parent_id']) {
               $html .= "<option value='{$cat['id']}' " .$selected .($selfId && ($selfId == $cat['id']) ? ' disabled' : null) .">" .$cat['name'] ."</option>";
            }else{
               $html .= "<option value='{$cat['id']}' " .$selected .($selfId && ($selfId == $cat['id']) ? ' disabled' : null) .">" .$space .$cat['name'] ."</option>";

            }
         }

      }
      echo $html;
   }

}
