<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user->is_super_admin) {
            return response()->json(['error' => 'You do not have permission to access this page.'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
