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
         $paginator = Category::orderBy('created_at', 'desc')
               ->where('status', 1)
               ->paginate(Setting::get('data_per_page', 25));

         $categories = $paginator->each(function ($category) {
                     $category->makeHidden([
                        'image_file',
                        'status',
                        'parent_id',
                        'updated_at',
                        'pivot',
                        'slug'
                     ]);
                  });

         $paginator->data = $categories;

         return $this->successResponse($paginator, 'Category data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
      }
        
    }
}
