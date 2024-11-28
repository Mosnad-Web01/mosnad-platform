<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Check if the user has the required role
        if (!$this->hasRole($request->user(), $role)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }

    /**
     * Determine if the user has the required role.
     *
     * @param  \App\Models\User  $user
     * @param  string  $role
     * @return bool
     */
    protected function hasRole($user, $role): bool
    {
        switch ($role) {
            case 'admin':
                return $user->isAdmin();
            case 'company':
                return $user->isCompany();
            case 'student':
                return $user->isStudent();
            default:
                return false;
        }
    }
}
