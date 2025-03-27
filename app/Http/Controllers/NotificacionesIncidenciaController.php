<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones_Incidencia;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NotificacionesIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            );
        //        dd($notificaciones);
        return Inertia::render('Layouts/Header', [
            'notificaciones' => $notificaciones->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificaciones_Incidencia $notificaciones_Incidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificaciones_Incidencia $notificaciones_Incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificaciones_Incidencia $notificaciones_Incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificaciones_Incidencia $notificaciones_Incidencia)
    {
        //
    }
}
