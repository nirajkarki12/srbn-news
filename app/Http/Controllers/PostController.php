<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Category;
use App\Models\Post;

class PostController extends BaseApiController
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
    public function index(int $categoryId = null)
    {
      try {

         $paginator = Post::with('categories')
               ->orderBy('created_at', 'desc')
               ->where('status', 1);

         if($categoryId) {
            $paginator = $paginator->whereHas('categories', function($q) use($categoryId) {
                           $q->where('categories.id', $categoryId);
                        });
         }

         $paginator = $paginator->paginate(Setting::get('data_per_page', 25));

         $posts = $paginator->each(function ($post) {
                     $post->makeHidden([
                        'image_file',
                        'status',
                        'category_id',
                        'updated_at',
                        'slug'
                     ]);
                     $post->categories->each(function($category) {
                        $category->makeHidden([
                           'image_file',
                           'status',
                           'parent_id',
                           'updated_at',
                           'pivot',
                           'slug'
                        ]);
                     });
                  });

         $paginator->data = $posts;

         return $this->successResponse($paginator, 'Post data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
      }
        
    }

}
