<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = $request->user();

        if (!$user) {
            return back()->with('error', 'You are not authorized to access this page.');
        }

        if ($user->can('all_permissions')) {
            return $next($request);
        }

        // Get all permissions assigned to the user
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();

        // Check if the user has at least one of the required permissions
        if (!array_intersect($permissions, $userPermissions)) {
            return back()->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
