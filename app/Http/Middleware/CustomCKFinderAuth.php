<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        config(['ckfinder.authentication' => function() use ($guard, $request) {
            return Auth::guard($guard)->check();
        }]);

        return $next($request);
    }
}
