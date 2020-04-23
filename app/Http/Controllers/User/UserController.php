<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Common\BaseController;
use App\Rules\CheckOldPassword;
use App\Models\User;

class UserController extends BaseController
{

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct() {}

  /**
   * Display the specified resource.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
   public function index()
   {
      $provinces = Province::all();
      $user = Auth::guard('user')->user();
      return view('user.user.profile', compact('user', 'provinces'));
   }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    try {
      $validator = Validator::make( $request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'address' => ['required', 'string', 'max:255'],
      ],
      [],
      [
         'name' => 'Full Name',
         'address' => 'Address',
        ]
      );

      if ($validator->fails())
				return redirect()
					->back()
					->withErrors($validator)
					->withInput();

      if(!User::whereId(Auth::guard('user')->user()->id)->update($request->except('_token'))) throw new \Exception("Error Processing Request", 1);

      return redirect()->route('user.dashboard')->with('flash_success', 'Profile updated Successfully');

    } catch (\Exception $e) {
      return back()->with('flash_error', $e->getMessage())->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function changePassword()
  {
		$user = Auth::guard('user')->user();
		return view('user.user.change-password', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function savePassword(Request $request)
  {
      try {
        $validator = Validator::make( $request->all(), [
          'current_password' => ['required', new CheckOldPassword],
          'password' => ['required', 'string', 'min:6', 'confirmed', 'different:current_password'],
          ]
        );

        if ($validator->fails())
					return redirect()
						->back()
						->withErrors($validator)
						->withInput();

        if(!User::whereId(Auth::guard('user')->user()->id)->update(['password' => Hash::make($request->password)])) throw new \Exception("Error Processing Request", 1);

        return redirect()->route('user.dashboard')->with('flash_success', 'Password Changed Successfully');

      } catch (\Exception $e) {
        return back()->with('flash_error', $e->getMessage())->withInput();
      }
  }
}
