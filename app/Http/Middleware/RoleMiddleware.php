<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verifica si el usuario tiene el rol adecuado
        /* if (auth()->user()->role !== $role) {
            // Redirige si no tiene el rol adecuado
            return redirect('/');
        } */

        return $next($request);
    }
}
