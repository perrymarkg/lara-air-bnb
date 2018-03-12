<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( ! Auth::guard()->check() || Auth::user()->user_type !== 'host' ){
            return redirect('/')->with('notice', 'Invalid access');
        }

        return $next($request);
    }
}
