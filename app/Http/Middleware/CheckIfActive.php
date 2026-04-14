<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckIfActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->account_status !== 'active') {
            // Allow access only to dashboard or logout to prevent dead-ends
            $allowedRoutes = ['dashboard', 'logout'];
            if (!in_array(Route::currentRouteName(), $allowedRoutes)) {
                return redirect()->route('dashboard')->with('error', 'Your account is inactive.');
            }
        }
        return $next($request);
    }
}
