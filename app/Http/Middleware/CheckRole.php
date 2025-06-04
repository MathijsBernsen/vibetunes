<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($role && !$user->hasRole($role)) {
            // If the user does not have the required role, redirect or abort
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this resource.');
        }


        return $next($request);
    }
}
