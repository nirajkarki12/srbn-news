<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use anlutro\LaravelSettings\Facade as Setting;
use App\Models\Category;
use App\Models\Post;

/**
* @group Category
*/
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
   * Root Categories
   * Active Root Categories
   * @urlParam /parentId category childs
   * @response {
   *  "status": true,
   *  "data": [
   *   {
   *    "id": 2,
   *    "name": "News",
   *    "description": null,
   *    "image": null,
   *    "created_at": "2020-04-14 15:00"
   *   },
   *   {
   *    "id": 3,
   *    "name": "Entertainment",
   *    "description": null,
   *    "image": null,
   *    "created_at": "2020-04-14 15:10"
   *   }
   *  ],
   * "message": "Categories data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Categories not found",
   *  "code": 200
   * }
   */
   public function index(int $parentId = null)
   {
      try {

         $categories = Category::orderBy('name', 'asc')
                     ->where(['status' => 1, 'parent_id' => $parentId])
                     ->get();

         $categories = $categories->each(function ($category) {
                     $category->makeHidden([
                        'image_file',
                        'status',
                        'parent_id',
                        'updated_at',
                        'slug'
                     ]);
                  })->toArray();

         if(count($categories) === 0) throw new \Exception("Categories not found", Response::HTTP_OK);
        
         return $this->successResponse($categories, 'Categories data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }

   /**
   * Categories Tree
   * Active Categories Tree Structure
   * @response {
   *  "status": true,
   *  "data": [
   *   {
   *    "id": 2,
   *    "name": "News",
   *    "description": null,
   *    "image": null,
   *    "created_at": "2020-04-14 15:00",
   *    "children": [
   *     {
   *      "id": 3,
   *      "name": "News Children",
   *      "description": null,
   *      "image": null,
   *      "created_at": "2020-04-14 15:00",
   *      "children": [
   *       {
   *        "id": 4,
   *        "name": "Sub News Children",
   *        "description": null,
   *        "image": null,
   *        "created_at": "2020-04-14 15:00"
   *       }
   *      ]
   *     }
   *    ]
   *   }
   *  ],
   * "message": "Categories data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Categories not found",
   *  "code": 200
   * }
   */
   public function categoryTree()
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

         if(count($arrCategory) === 0) throw new \Exception("Categories not found", Response::HTTP_OK);
        
         return $this->successResponse($arrCategory, 'Categories data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }

   /**
   * User's Categories 
   * Header: X-Authorization: Bearer {token}
   * @response {
   *  "status": true,
   *  "data": [
   *   {
   *    "id": 2,
   *    "name": "News",
   *    "description": null,
   *    "image": null,
   *    "created_at": "2020-04-14 15:00"
   *   }
   *  ],
   * "message": "Categories data fetched successfully",
   * "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "User not found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Categories not found",
   *  "code": 200
   * }
   * @response 200 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 200
   * }
   */
   public function userCategories()
   {
      try {

         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_OK);

         $usrCategories = $user->userCategories;

         $ids = [];
         foreach ($usrCategories as $cat) {
            array_push($ids, $cat->id);
         }

         $categories = Category::orderBy('name', 'asc')
                     ->where('status', 1)
                     ->whereIn('categories.id', $ids)
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

         if(count($arrCategory) === 0) throw new \Exception("Categories not found", Response::HTTP_OK);
        
         return $this->successResponse($arrCategory, 'Categories data fetched successfully');

      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
        
   }
}
