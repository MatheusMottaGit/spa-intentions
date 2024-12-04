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
            return redirect()->route('sign');
        }

        if (!auth()->user()->hasRole($roleName)) {
            return redirect()->route('home')->with('warning', 'Pode ser que você não possa acessar essa página!');
        }

        return $next($request);
    }
}