<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Common\BaseController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use \Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;

class VerificationController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::USER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Where to redirect users after verification.
     *
     */
    protected function redirectTo() {
        return route('user.dashboard');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('user.dashboard')->with('flash_success', 'Email Address has been verified Successfully.');
    }
}
