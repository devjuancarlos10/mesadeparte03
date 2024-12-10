<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle($request, Closure $next)
    {
        // Si el usuario está autenticado, redirigir al dashboard
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
