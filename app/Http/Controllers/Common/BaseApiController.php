<?php

namespace App\Http\Controllers\Common;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BaseApiController extends Controller
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   protected $guard;

   public function __construct()
   {
      $this->guard = Auth::guard('api');
   }

   public function successResponse($data = array(), string $message = 'Successful', int $code = 200, array $header = []) {
      $res = response()->json([
         'status' => true,
         'data' => $data,
         'message' => $message,
         'code' => $code,
      ], $code);

      if($header && is_array($header)) {
         foreach ($header as $key => $value) {
            $res->header($key, $value);
         }
      }

      return $res;
   }

   public function errorResponse(string $message = 'error', int $code = 404) {
      return response()->json([
         'status' => false,
         'message' => $message,
         'code' => $code,
      ], $code);
   }

   /**
   * Get the authenticated User
   *
   * @return \Illuminate\Http\JsonResponse
   */
   public function guard()
   {
      return Auth::user();
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

}
