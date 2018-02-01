<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) 
        {
            // if (auth()->user()->verified == 0)
            // {
            //     auth()->logout();
            //     return redirect('/login')->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            // }

            return redirect('/dashboard');
        }

        return $next($request);
    }
}
