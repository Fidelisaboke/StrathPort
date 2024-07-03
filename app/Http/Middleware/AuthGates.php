<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;


class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {

        if (Auth::check()) {
            if ($role) {
                if (! Auth::user()->roles()->where('name', $role)->exists()) {
                    abort(403, 'Unauthorized');
                }
            } else {
                $allowedRoles = ['admin', 'student', 'staff', 'carpool_driver'];
                if (! Auth::user()->roles()->whereIn('name', $allowedRoles)->exists()) {
                    abort(403, 'Unauthorized');
                }
            }
        } else {
            return redirect('login');
        }
        return $next($request);
    }
}
