<?php

namespace App\Http\Middleware;

use App\Services\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = Route::currentRouteName();

        if (!UserPermission::canAccess($routeName)) {
            return response()->json(['error' => 'You do not have permission to access this page.'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
