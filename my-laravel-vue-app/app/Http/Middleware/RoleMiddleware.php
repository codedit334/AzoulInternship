<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Get the logged-in user
        $user = Auth::user();

        // Check if the user has the right role
        if (!in_array($user->role, $roles)) {
            // If the user doesn't have the correct role, return a 403 Forbidden response or redirect
            return response()->json(['message' => 'You do not have permission to access this page'], 403);
        }

        // If the user has the right role, proceed to the next request
        return $next($request);
    }
}

?>