<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Common\BaseApiController;
use Hash;
use Validator;
use App\Http\Helpers\Helper;
use App\Models\User;

class UserController extends BaseApiController
{
   /**
   * Create a new UserController instance.
   *
   * @return void
   */
   public function __construct()
   {
      parent::__construct();
   }

   /**
   * Login APIs
   * User Login
   * @group User
   * APIs for User Login
   * @bodyParam email string required valid email address.
   * @bodyParam password string required min 6 in length.
   * @response {
   *  "status": true,
   *  "data": {
   *   "name": "Name Example",
   *   "email": "example@gmail.com",
   *   "address": "Somewhere",
   *   "image": null,
   *   "created_at": "2020-04-14 15:00",
   *   "token": "JWT Token"
   *  },
   * "message": "Logged in successfully",
   * "code": 200
   * }
   * @response 401 {
   *  "status": false,
   *  "message": "Username/Password Mismatched",
   *  "code": 401
   * }
   */
   public function login(Request $request)
   {
      try {
            
         $credentials = $request->only('email', 'password');

         if (!$token = $this->guard->attempt($credentials)) throw new \Exception('Username/Password Mismatched', Response::HTTP_UNAUTHORIZED);
            
         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_UNAUTHORIZED);
            
         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
            'created_at' => $user->created_at,
            'token' => $token
         ];
         return $this->successResponse($response, 'Logged in successfully');

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

   /**
   * Registration APIs
   * User Registration
   * @group User
   * @bodyParam name string required max 100 in length.
   * @bodyParam email string required valid email address.
   * @bodyParam address string max 100 in length.
   * @bodyParam password string required min 6 in length.
   * @bodyParam image file accepts: jpeg,png,gif, filesize upto 2MB.
   * @response 201 {
   *  "status": true,
   *  "data": {
   *   "name": "Name Example",
   *   "email": "example@gmail.com",
   *   "address": "Somewhere",
   *   "image": null,
   *   "created_at": "2020-04-14 15:00",
   *   "token": "JWT Token"
   *  },
   * "message": "Registered successfully",
   * "code": 201
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The Full Name field is required.",
   *  "code": 406
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The email has already been taken.",
   *  "code": 406
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The password must be at least 6 characters.",
   *  "code": 406
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The Image failed to upload.",
   *  "code": 406
   * }
   */
   public function register(Request $request)
   {
      try {

         $data = $request->except('_token');

         $validator = Validator::make( $data, [
               'name' => 'required|max:100',
               'email' => 'required|email|unique:users',
               'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2058',
               'address' => 'nullable|max:100',
               'password' => 'required|min:6',
            ],
            [],
            [
               'name' => 'Full Name',
               'image' => 'Image',
            ]
         );
         if($validator->fails()) throw new \Exception($validator->messages()->first(), Response::HTTP_NOT_ACCEPTABLE);

         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->password = Hash::make($request->password);

         if($request->file('image')) {
            if(!$file = Helper::uploadImage($request->file('image'), 'user')) throw new \Exception("Cannot Save Image", Response::HTTP_NOT_ACCEPTABLE);
            $user->image_file = $file;
         }

         $user->save();
            
         if (!$token = $this->guard->attempt(['email' => $user->email, 'password' => $request->password])) throw new \Exception('Something went wrong', Response::HTTP_UNAUTHORIZED);
         
         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
            'created_at' => $user->created_at,
            'token' => $token
         ];
         return $this->successResponse($response, 'Registered successfully', Response::HTTP_CREATED);

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

   /**
   * Authenticated User
   * Header: X-Authorization: Bearer {token}
   * @group User
   * @response {
   *  "status": true,
   *  "data": {
   *   "name": "Name Example",
   *   "email": "example@gmail.com",
   *   "address": "Somewhere",
   *   "image": null,
   *   "categories": [
   *     {
   *        "id": 2,
   *        "name": "News",
   *        "description": null,
   *        "image": null,
   *        "created_at": "2020-04-14 15:00"
   *     }
   *    ],
   *   "created_at": "2020-04-14 15:00"
   *  },
   * "message": "User info fetched successfully",
   * "code": 200
   * }
   * @response 401 {
   *  "status": false,
   *  "message": "User not found",
   *  "code": 401
   * }
   * @response 400 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 400
   * }
   */
   public function getUser()
   {
      try {
         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_UNAUTHORIZED);

         $categories = $user->userCategories->each(function ($category) {
                     $category->makeHidden([
                        'image_file',
                        'status',
                        'parent_id',
                        'updated_at',
                        'slug',
                        'pivot'
                     ]);
                  });

         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
            'categories' => $categories,
            'created_at' => $user->created_at,
         ];

         return $this->successResponse($response, 'User info fetched successfully');
      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
      }
   }

   /**
   * Set Category APIs
   * Header: X-Authorization: Bearer {token}
   * @group User
   * @bodyParam categories array required [categories ID].
   * @response {
   *  "status": true,
   *  "data": {
   *   "name": "Name Example",
   *   "email": "example@gmail.com",
   *   "address": "Somewhere",
   *   "image": null,
   *   "categories": [
   *     {
   *        "id": 2,
   *        "name": "News",
   *        "description": null,
   *        "image": null,
   *        "created_at": "2020-04-14 15:00"
   *     }
   *    ],
   *   "created_at": "2020-04-14 15:00"
   *  },
   * "message": "User Categories Added successfully",
   * "code": 200
   * }
   * @response 401 {
   *  "status": false,
   *  "message": "User not found",
   *  "code": 401
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The categories field is required.",
   *  "code": 406
   * }
   * @response 400 {
   *  "status": false,
   *  "message": "Invalid Request",
   *  "code": 400
   * }
   */
   public function setUserCategories(Request $request)
   {
      try {

         if(!$user = $this->guard->user()) throw new \Exception("User not found", Response::HTTP_UNAUTHORIZED);

         $data = $request->except('_token');

         $validator = Validator::make( $data, [
               'categories' => 'required',
            ]
         );
         if($validator->fails()) throw new \Exception($validator->messages()->first(),  Response::HTTP_NOT_ACCEPTABLE);

         if(isset($data['categories']))
         {
             $user->userCategories()->detach();
             $user->userCategories()->attach($data['categories']);
         }

         $categories = $user->userCategories->each(function ($category) {
                     $category->makeHidden([
                        'image_file',
                        'status',
                        'parent_id',
                        'updated_at',
                        'slug',
                        'pivot'
                     ]);
                  });
         
         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
            'categories' => $categories,
            'created_at' => $user->created_at,
         ];
         return $this->successResponse($response, 'User Categories Added successfully');

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard->logout();

        return $this->successResponse([], 'Successfully logged out');
    }

    /**
   * Social Login APIs
   * Social User Login
   * @group User
   * APIs for Social User Login
   * @bodyParam name string optional name of user.
   * @bodyParam email string optional valid email address.
   * @bodyParam image string optional image link of user.
   * @bodyParam social_id string required social id of user.
   * @bodyParam provider string required social provider eg.facebook.
   * 
   * @response {
   *  "status": true,
   *  "data": {
   *   "name": "Name Example",
   *   "email": "example@gmail.com",
   *   "address": "Somewhere",
   *   "image": null,
   *   "created_at": "2020-04-14 15:00",
   *   "token": "JWT Token"
   *  },
   * "message": "Logged in successfully",
   * "code": 200
   * }
   * @response 406 {
   *  "status": false,
   *  "message": "The social id field is required.",
   *  "code": 406
   * }
   */
   public function socialLogin(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'social_id' => 'required',
            'provider' => 'required'
         ]);

         if($validator->fails()) throw new \Exception($validator->errors()->first(),  Response::HTTP_NOT_ACCEPTABLE);
         
         $user = User::where('social_id', $request->social_id)->where('provider', $request->provider)->first();

         if(!$user) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->social_id = $request->social_id;
            $user->provider = $request->provider;
            $user->image = $request->image;
            $user->save();
         }
    
         $user->updated_at = new \DateTime();
         $user->save();
         
         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
            'created_at' => $user->created_at,
            'token' => auth()->login($user)
         ];

         return $this->successResponse($response, 'Logged in successfully');

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), $e->getCode());
     }
   }

}
