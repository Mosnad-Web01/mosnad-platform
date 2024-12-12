<?php

// app/Http/Middleware/CheckPermission.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
          // check if the user has the required permission
        if (!$request->user()?->hasPermission($permission)) {

            // if the user does not have the required permission, abort with a 403 error
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
