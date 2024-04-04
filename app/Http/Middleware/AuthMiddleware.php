<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
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
        $restrictedRoutes = ['login.index', 'register.index'];

        $currentRoute = $request->route()->getName();

        if (Auth::check() && in_array($currentRoute, $restrictedRoutes)) {
            return redirect()->route('home.index')->with('info', 'You are already logged in.');
        }  
        
        if (!Auth::check() && !in_array($currentRoute, $restrictedRoutes)){
            return redirect()->route('login.index')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
