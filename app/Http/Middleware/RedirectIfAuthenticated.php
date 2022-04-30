<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next, $guard = null)
    {
        
        switch ($guard) {
            case 'client' :
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('customer.home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
        }
        return $next($request);
    }
}
