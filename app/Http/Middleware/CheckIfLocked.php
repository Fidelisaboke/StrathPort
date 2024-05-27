<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class CheckIfLocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the session has a locked key and the current path is not 'lock'
        if (session('locked', false) && !Route::is('lock') && !Route::is('unlock')) {
            return redirect()->route('lock');
        }

        return $next($request);
    }
}
