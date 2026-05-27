<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * Verifica que la sesión tenga la marca 'admin_authenticated'.
     * También controla el tiempo de inactividad: si han pasado más
     * de 'admin.session_lifetime' minutos sin actividad, cierra
     * la sesión automáticamente.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = $request->session();

        if (! $session->get('admin_authenticated', false)) {
            return redirect()->route('admin.login')
                ->with('error', 'Debes iniciar sesión para acceder al panel de administración.');
        }

        // Verificar tiempo de inactividad
        $lifetime = config('admin.session_lifetime', 30); // minutos
        $lastActivity = $session->get('admin_last_activity', now()->timestamp);

        if (now()->timestamp - $lastActivity > ($lifetime * 60)) {
            // Sesión expirada por inactividad
            $session->forget('admin_authenticated');
            $session->forget('admin_last_activity');
            $session->regenerate();

            return redirect()->route('admin.login')
                ->with('error', 'Tu sesión ha expirado por inactividad. Ingresa nuevamente.');
        }

        // Actualizar marca de última actividad
        $session->put('admin_last_activity', now()->timestamp);

        return $next($request);
    }
}
