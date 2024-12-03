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
    public function handle(Request $request, Closure $next, string $roleName): Response
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Acesso não autorizado.']);
        }

        if (!auth()->user()->hasRole($roleName)) {
            return response()->json(['message' => 'Acesso negado! Sua função não permite acessar essa página.']);
        }

        return $next($request);
    }
}