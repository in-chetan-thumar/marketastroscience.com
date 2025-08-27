<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicationAccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $accessCheckSkipRoutesName = []; // Add any routes you want to skip permission check

        // Modify route name for permission checking
        $modifiedRouteName = $this->modifyRouteName($routeName);

        // Check if user has permission or route is in skip list
        if (auth()->user()->can($modifiedRouteName) || in_array($routeName, $accessCheckSkipRoutesName)) {
            return $next($request);
        }

        // If no permission, abort with 404
        abort(404, 'Sorry, this route is restricted by administrator');
    }

    /**
     * Modify route name for consistent permission checking
     *
     * @param string $routeName
     * @return string
     */
    protected function modifyRouteName($routeName)
    {
        // Handle .store and .update routes
        if (Str::contains($routeName, '.store')) {
            return str_replace('.store', '.create', $routeName);
        }

        if (Str::contains($routeName, '.update')) {
            return str_replace('.update', '.edit', $routeName);
        }

        // Special handling for .data routes
        if (Str::contains($routeName, '.data')) {
            // Replace .data with .index or .list, depending on your route naming convention
            return str_replace('.data', '.index', $routeName);
        }

        return $routeName;
    }
}