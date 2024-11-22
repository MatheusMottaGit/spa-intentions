<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roleName, string $method): Response
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $user = Auth::user();

        if ($user->role->role_name !== $roleName) {
            return response()->json(['message' => "Access denied: Your role doesn't have access here."], 403);
        }

        return $next($request);
    }
}
