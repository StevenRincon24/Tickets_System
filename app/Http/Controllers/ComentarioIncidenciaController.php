<?php

namespace App\Http\Controllers;

use App\Models\Comentario_Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $incidenciaId)
    {
        // Validar la solicitud
        $request->validate([
            'comentario' => 'required|string|max:255',
        ]);

        // Crear el comentario
        $comentario = new Comentario_Incidencia();
        $comentario->incidencia_id = $incidenciaId;
        $comentario->user_id = Auth::user()->id;
        $comentario->descripcion = $request->comentario;
        $comentario->save();
        return back()->with('success', 'Comentario agregado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario_Incidencia $comentario_Incidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario_Incidencia $comentario_Incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario_Incidencia $comentario_Incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario_Incidencia $comentario_Incidencia)
    {
        //
    }
}
