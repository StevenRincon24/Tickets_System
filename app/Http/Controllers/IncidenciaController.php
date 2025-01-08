<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\Incidencia;
use App\Models\TipoIncidencias;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidencias = DB::table('incidencias')
            ->join('tipo_incidencias', 'incidencias.tipo_incidencia_id', '=', 'tipo_incidencias.id')
            ->join('users', 'incidencias.user_id', '=', 'users.id')
            ->join('dependencias', 'incidencias.dependencia_id', '=', 'dependencias.id')
            ->where('incidencias.user_id', Auth::user()->id)
            ->select(
                'incidencias.created_at',
                'incidencias.titulo',
                'incidencias.descripcion',
                'incidencias.criticidad',
                'incidencias.estado',
                'tipo_incidencias.nombre as tipo_incidencia',
                'users.name as usuario',
                'dependencias.nombre as dependencia'
            )
            ->orderBy('incidencias.created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Ticket/Index', [
            'incidencias' => $incidencias
        ]);
    }

    public function incidenciasGenerales()
    {
        $incidencias = DB::table('incidencias')
            ->join('tipo_incidencias', 'incidencias.tipo_incidencia_id', '=', 'tipo_incidencias.id')
            ->join('users', 'incidencias.user_id', '=', 'users.id')
            ->join('dependencias', 'incidencias.dependencia_id', '=', 'dependencias.id')
            ->select(
                'incidencias.created_at',
                'incidencias.id',
                'incidencias.titulo',
                'incidencias.descripcion',
                'incidencias.criticidad',
                'incidencias.estado',
                'tipo_incidencias.nombre as tipo_incidencia',
                'users.name as usuario',
                'dependencias.nombre as dependencia'
            )
            ->orderBy('incidencias.created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Ticket/TicketsGenerales', [
            'incidencias' => $incidencias
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Ticket/Create', [
            'tipo_incidencias' => TipoIncidencias::all(),
            'dependencias' => Dependencia::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_incidencia_id' => 'required|exists:tipo_incidencias,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'descripcion' => 'required|string',
            'criticidad' => 'required',
        ]);
        $userlog = Auth::user();
        $user = User::find($userlog->id);

        Incidencia::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_incidencia_id' => $request->tipo_incidencia_id,
            'criticidad' => $request->criticidad,
            'estado' => 'Pendiente',
            'user_id' => $user->id,
            'dependencia_id' => $request->dependencia_id
        ]);

        return redirect()->back()->with('success', 'Incidencia registrada y notificada al equipo encargado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incidencia $incidencia)
    {
        // Obtener la incidencia con el nombre de la dependencia
        $incidencia = DB::table('incidencias')
            ->join('dependencias', 'incidencias.dependencia_id', '=', 'dependencias.id')
            ->select(
                'incidencias.*', // Selecciona todas las columnas de incidencias
                'dependencias.nombre as dependencia' // Selecciona el nombre de la dependencia
            )
            ->where('incidencias.id', $incidencia->id) // Filtra por la incidencia actual
            ->first(); // Obtiene solo un registro (la incidencia actual)

        // Pasa la incidencia con el nombre de la dependencia a la vista
        return Inertia::render('Ticket/Show', [
            'incidencia' => $incidencia
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
