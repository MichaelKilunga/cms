<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->user()->hasRole($role)) {
            abort(403, 'User does not have the right roles.');
        }

        return $next($request);
    }
}
