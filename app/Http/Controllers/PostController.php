<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Category;
use App\Models\Post;
use Auth;
use DB;

/**
* @group Post
*/
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
   * Posts List
   * All posts list
   * @queryParam ?page= next page - pagination
   * @queryParam ?lang=en user preffered language en for english and ne for nepali
   * @urlParam /categoryId specific category Posts
   * @response {
   *  "status": true,
   *  "data": {
   *   "current_page": 2,
   *   "data": [
   *    {
   *     "id": 1,
   *     "title": "News Title",
   *     "description": "News Long Description",
   *     "type": "Image|Video",
   *     "content": "Image URL|Video URL",
   *     "note": "News notes",
   *     "source": "News Source",
   *     "source_url": "Source URL",
   *     "audio_url": "URL|null",
   *     "lang":"en",
   *     "created_at": "2020-04-14 15:00",
   *     "categories": [
   *      {
   *        "id": 2,
   *        "name": "News",
   *        "description": null,
   *        "image": null,
   *        "created_at": "2020-04-14 15:00"
   *      }
   *     ]
   *    }
   *   ],
   *   "first_page_url": "URL/api/posts?page=1",
   *   "from": 16,
   *   "last_page": 4,
   *   "last_page_url": "URL/api/posts?page=4",
   *   "next_page_url": "URL/api/posts?page=3",
   *   "path": "URL/api/posts",
   *   "per_page": 15,
   *   "prev_page_url": "URL/api/posts?page=1",
   *   "to": 30,
   *   "total": 55
   * },
   * "message": "Post data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "No Posts found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 200
   * }
   */
   public function index(int $categoryId = null)
   {
      try {

         $lang = request('lang')?:'en';

         $paginator = Post::select([
               'posts.*',
               DB::raw('
                     (
                        CASE
                        WHEN posts.type = ' .Post::TYPE_IMAGE .' THEN "' .Post::$postTypes[Post::TYPE_IMAGE] .'"'
                        .' WHEN posts.type = ' .Post::TYPE_VIDEO .' THEN "' .Post::$postTypes[Post::TYPE_VIDEO] .'"'
                        .' ELSE null
                        END
                     ) AS type
                  '),
               ])
               ->with('categories')
               ->where('lang', $lang)
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
                        'status',
                        'category_id',
                        'updated_at',
                        'slug'
                     ]);
                     $post->categories->each(function($category) {
                        $category->makeHidden([
                           'image_file',
                           'status',
                           'updated_at',
                           'pivot',
                           'slug'
                        ]);
                     });
                  });

         $paginator->data = $posts;

         if (!$paginator->count()) throw new \Exception("No Posts found", Response::HTTP_OK);

         return $this->successResponse($paginator, 'Post data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 500);
      }

   }

   /**
   * User's Posts List
   * Header for User's Category Posts: X-Authorization: Bearer {token}
   * @queryParam ?page= next page - pagination
   * @response {
   *  "status": true,
   *  "data": {
   *   "current_page": 2,
   *   "data": [
   *    {
   *     "id": 1,
   *     "title": "News Title",
   *     "description": "News Long Description",
   *     "type": "Image|Video",
   *     "content": "Image URL|Video URL",
   *     "note": "News notes",
   *     "source": "News Source",
   *     "source_url": "Source URL",
   *     "audio_url": "URL|null",
   *     "is_poll": "true/false",
   *     "created_at": "2020-04-14 15:00",
   *     "categories": [
   *      {
   *        "id": 2,
   *        "name": "News",
   *        "description": null,
   *        "image": null,
   *        "created_at": "2020-04-14 15:00"
   *      }
   *     ]
   *    }
   *   ],
   *   "first_page_url": "URL/api/posts/user?page=1",
   *   "from": 16,
   *   "last_page": 4,
   *   "last_page_url": "URL/api/posts/user?page=4",
   *   "next_page_url": "URL/api/posts/user?page=3",
   *   "path": "URL/api/posts/user",
   *   "per_page": 15,
   *   "prev_page_url": "URL/api/posts/user?page=1",
   *   "to": 30,
   *   "total": 55
   * },
   * "message": "Post data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "User not found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "No Posts found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 200
   * }
   */
   public function userPosts()
   {
      try {

         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_OK);

         $paginator = Post::select([
               'posts.*',
               DB::raw('
                     (
                        CASE
                        WHEN posts.type = ' .Post::TYPE_IMAGE .' THEN "' .Post::$postTypes[Post::TYPE_IMAGE] .'"'
                        .' WHEN posts.type = ' .Post::TYPE_VIDEO .' THEN "' .Post::$postTypes[Post::TYPE_VIDEO] .'"'
                        .' ELSE null
                        END
                     ) AS type
                  '),
               ])
                ->with('categories')
                ->orderBy('created_at', 'desc')
                ->where('status', 1);

         $ids = [];
         $categories = $user->userCategories;

         foreach ($categories as $cat) {
            array_push($ids, $cat->id);
         }

         if(count($ids) > 0) {
            $paginator = $paginator->whereHas('categories', function($q) use($ids) {
               $q->whereIn('categories.id', $ids);
            });
         }

         $paginator = $paginator->paginate(Setting::get('data_per_page', 25));

         $posts = $paginator->each(function ($post) {
                     $post->makeHidden([
                        'status',
                        'category_id',
                        'updated_at',
                        'slug'
                     ]);
                     $post->categories->each(function($category) {
                        $category->makeHidden([
                           'image_file',
                           'status',
                           'updated_at',
                           'pivot',
                           'slug'
                        ]);
                     });
                  });

         $paginator->data = $posts;

         if (!$paginator->count()) throw new \Exception("No Posts found", Response::HTTP_OK);

         return $this->successResponse($paginator, 'Post data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }

   }

    /**
     * Post Views Increment
     * @bodyParam postId integer required option id.
     * @response 201 {
     *  "status": true,
     *  "data": [
     *  ],
     * "message": "Done successfully",
     * "code": 201
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "The post id field is required.",
     *  "code": 200
     * }
     * @response 200 {
     *  "status": false,
     *  "message": "Invalid Request",
     *  "code": 200
     * }
     */
    public function postTotalViews(Request $request)
    {
        try {
            $validator = Validator::make( $request->all(), [
                    'postId' => 'required',
                ]
            );
            if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_OK);

            Post::where('id', $request->postId)
                ->increment('total_views', 1);

            return $this->successResponse([], 'Done successfully', Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

}
