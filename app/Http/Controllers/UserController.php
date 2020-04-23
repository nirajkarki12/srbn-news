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
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
   public function getUser()
   {
      try {
         if(!$user = $this->guard->user()) throw new \Exception("User not found", 1);

         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
         ];

         return $this->successResponse($response, 'User info fetched successfully');
      } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
      }
   }

   public function login(Request $request)
   {
      try {
            
         $credentials = $request->only('email', 'password');

         if (!$token = $this->guard->attempt($credentials)) throw new \Exception('Username/Password Mismatched', 1);
            
         if(!$user = $this->guard->user()) throw new \Exception("User not found", 1);
            
         // $user->notify(new \App\User\Notifications\LoginEmail($user));
         return $this->successResponse($user, 'Logged in successfully', 200, ['X-Authorization' => $token]);

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
     }
   }

   public function register(Request $request)
   {
      try {

         $data = $request->except('_token');

         $validator = Validator::make( $data, [
               'name' => 'required|max:255',
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
         if($validator->fails()) throw new \Exception($validator->messages()->first(), 1);

         $user = new User;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->password = Hash::make($request->password);

         if($request->file('image')) {
            if(!$file = Helper::uploadImage($request->file('image'), 'user')) throw new \Exception("Cannot Save Image", 1);
            $user->image_file = $file;
         }

         $user->save();
            
         if (!$token = $this->guard->attempt(['email' => $user->email, 'password' => $request->password])) throw new \Exception('Something went wrong', 1);
         
         $response = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'image' => $user->image,
         ];
         return $this->successResponse($response, 'Registered successfully', 200, ['X-Authorization' => $token]);

     } catch (\Exception $e) {
         return $this->errorResponse($e->getMessage(), 406);
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

}
