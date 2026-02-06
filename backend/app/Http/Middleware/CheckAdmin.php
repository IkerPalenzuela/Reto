<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // ¿El usuario está logueado?
        if (!auth()->check()) {
            // No está logueado → lo mandamos al login
            return redirect()->route('login');
        }

        // ¿El usuario es admin?
        if (!auth()->user()->is_admin) {
            // No es admin → lo mandamos al dashboard normal
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos de administrador');
        }

        // Sí es admin → lo dejamos pasar
        return $next($request);
    }
}