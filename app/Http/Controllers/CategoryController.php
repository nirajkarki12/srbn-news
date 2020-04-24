<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {

         $categories = Category::orderBy('name', 'asc')
                     ->where('status', 1)
                     ->get();
         $categories = $categories->each(function ($category) {
                     $category->makeHidden([
                        'image_file',
                        'status',
                        'parent_id',
                        'updated_at',
                        'slug'
                     ]);
                  });
         $arrCategory = $this->buildCategoryTree($categories);
        
         return $this->successResponse($arrCategory, 'Category data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
      }
        
    }
}
