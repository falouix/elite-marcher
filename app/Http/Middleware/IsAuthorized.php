<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Route;


class IsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // dd(Route::currentRouteName());
        $routeName = Route::currentRouteName();
        
            return $next($request);
      
        return redirect('/customer');
       // return $next($request);
    }
}
