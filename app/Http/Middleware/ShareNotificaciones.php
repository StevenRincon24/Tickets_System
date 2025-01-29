<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ShareNotificaciones
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            // Ejecuta la consulta solo si hay un usuario autenticado
            $notificaciones = DB::table('notificaciones_incidencias')
            ->join('incidencias', 'notificaciones_incidencias.incidencia_id', '=', 'incidencias.id')
            ->join('users', 'notificaciones_incidencias.user_id', '=', 'users.id')
            ->join('dependencias', 'notificaciones_incidencias.dependencia_id', '=', 'dependencias.id')
            ->select(
                'notificaciones_incidencias.id',
                'notificaciones_incidencias.created_at',
                'notificaciones_incidencias.leido',
                'incidencias.titulo',
                'incidencias.descripcion',
                'incidencias.criticidad',
                'incidencias.estado',
                'users.name as usuario',
                'dependencias.nombre as dependencia'
            )
                ->where('notificaciones_incidencias.user_id', $request->user()->id) // Solo notificaciones del usuario autenticado
                ->paginate(10);

            // Comparte las notificaciones globalmente con todas las vistas
            Inertia::share('notificaciones', $notificaciones);
        }

        return $next($request);
    }
}
