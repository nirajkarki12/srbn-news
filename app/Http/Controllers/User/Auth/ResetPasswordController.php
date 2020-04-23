<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends BaseController
{
  /*
  |--------------------------------------------------------------------------
  | Password Reset Controller
  |--------------------------------------------------------------------------
  |
  | This controller is responsible for handling password reset requests
  | and uses a simple trait to include this behavior. You're free to
  | explore this trait and override any methods you wish to tweak.
  |
  */

  use ResetsPasswords;

  /**
   * Get the password reset validation rules.
   *
   * @return array
   */
  protected function rules()
  {
    return [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ];
  }

  protected function resetPassword(User $user, $password)
  {
    $user->password = Hash::make($password);

    $user->setRememberToken(\Str::random(60));
    $user->email_verified_at = new \DateTime();

    $user->save();

    event(new PasswordReset($user));
  }

  protected function sendResetResponse($response)
  {
    return redirect()->route('login')
            ->with('status', 'New Password Set Successfully, Please login to continue');
  }
}
