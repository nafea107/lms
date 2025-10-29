<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();
        if ($user && $user->hasRole($roles)) {
            return $next($request);
        }
        return abort(403, __('You are not allowed to access this page.'));
    }
}
