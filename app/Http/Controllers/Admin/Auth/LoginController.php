<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Common\BaseController;

class LoginController extends BaseController
{
   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

   use AuthenticatesUsers;

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
     $this->middleware('guest')->except('logout');
   }

   protected function redirectTo()
   {
      return RouteServiceProvider::ADMIN;
   }

   protected function guard()
   {
      return Auth::guard('admin');
   }

   public function showLoginForm()
   {
     return view('admin.auth.login');
   }

   public function logout() {
      $this->guard()->logout();
      return redirect()->route('admin.login');
   }

   /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => 'required|max:255',
         'email' => 'required|email|max:255|unique:admins',
         'password' => 'required|min:6|confirmed',
      ]);
   }


}
