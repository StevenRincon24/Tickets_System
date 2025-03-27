<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */

    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request)
    {
        // Realiza las consultas necesarias
        $incidenciasPendientes = \App\Models\Incidencia::where('estado', 'Pendiente')->count();
        $incidenciasEnProceso = \App\Models\Incidencia::where('estado', 'En Proceso')->count();
        $incidenciasFinalizadas = \App\Models\Incidencia::where('estado', 'Finalizada')->count();

        // Consulta de notificaciones
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
                'incidencias.estado',
                'users.name as usuario',
                'dependencias.nombre as dependencia'
            )
            ->where('incidencias.estado', '=', 'pendiente') // Condición para filtrar solo incidencias pendientes
            ->orderBy('notificaciones_incidencias.created_at', 'desc') // Ordenar por fecha (más recientes primero)
            ->limit(10) // Opcional: limitar el número de notificaciones mostradas
            ->get(); // Cambia a ->paginate() si necesitas paginación

        // Retorna los datos compartidos globalmente
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
            ],
            'showingMobileMenu' => false,
            'user.roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
            'user.permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],

            // Comparte las incidencias
            'incidenciasPendientes' => $incidenciasPendientes,
            'incidenciasEnProceso' => $incidenciasEnProceso,
            'incidenciasFinalizadas' => $incidenciasFinalizadas,

            // Comparte las notificaciones
            'notificaciones' => $notificaciones,
        ]);
    }

}
