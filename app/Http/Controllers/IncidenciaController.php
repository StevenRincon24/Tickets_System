<?php

namespace App\Http\Controllers;

use App\Events\IncidenciaCreada;
use App\Models\Dependencia;
use App\Models\Incidencia;
use App\Models\Notificaciones_Incidencia;
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
                'incidencias.id',
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

    // INCIDENCIAS POR DEPENDENCIA
    public function incidenciasPorDependencia()
    {
        $incidencias = DB::table('incidencias')
            ->join('dependencias', 'incidencias.dependencia_id', '=', 'dependencias.id')
            ->select(
                'dependencias.nombre as dependencia',
                DB::raw('count(incidencias.id) as total_incidencias'),
                DB::raw('sum(case when incidencias.estado = "Finalizada" then 1 else 0 end) as total_finalizadas'),
                DB::raw('sum(case when incidencias.estado = "En proceso" then 1 else 0 end) as total_en_proceso'),
                DB::raw('sum(case when incidencias.estado = "Pendiente" then 1 else 0 end) as total_pendientes')
            )
            ->groupBy('dependencias.id', 'dependencias.nombre') // Agrupar por dependencia
            ->paginate(10); // Paginación

        return Inertia::render('Ticket/TicketsDependencia', [
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
        // Validar los datos de la solicitud
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_incidencia_id' => 'required|exists:tipo_incidencias,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'descripcion' => 'required|string',
            'criticidad' => 'required',
        ]);

        // Obtener el usuario autenticado
        $userlog = Auth::user();
        $user = User::find($userlog->id);

        // Crear la incidencia
        $incidencia = Incidencia::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo_incidencia_id' => $request->tipo_incidencia_id,
            'criticidad' => $request->criticidad,
            'estado' => 'Pendiente',
            'user_id' => $user->id,
            'dependencia_id' => $request->dependencia_id,
        ]);

        // Disparar el evento IncidenciaCreada
        if ($incidencia) {
            event(new IncidenciaCreada($incidencia)); // Dispara el evento
        }

        // Retornar la respuesta
        return redirect()->back()->with('success', 'Incidencia registrada y notificada al equipo encargado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Incidencia $incidencia)
    {
        // Obtener la incidencia con el nombre de la dependencia, los comentarios asociados y los nombres de los usuarios
        $incidencia = DB::table('incidencias')
            ->join('dependencias', 'incidencias.dependencia_id', '=', 'dependencias.id')
            ->leftJoin('comentario_incidencias', 'comentario_incidencias.incidencia_id', '=', 'incidencias.id')
            ->leftJoin('users', 'comentario_incidencias.user_id', '=', 'users.id')
            ->select(
                'incidencias.*',
                'dependencias.nombre as dependencia',
                DB::raw('GROUP_CONCAT(comentario_incidencias.descripcion ORDER BY comentario_incidencias.id ASC) as comentarios'),
                DB::raw('GROUP_CONCAT(users.name ORDER BY comentario_incidencias.id ASC) as usuarios') // Concatenar los nombres de usuarios
            )
            ->where('incidencias.id', $incidencia->id)
            ->groupBy('incidencias.id', 'dependencias.nombre')
            ->first();

        // Separar los comentarios y los nombres de usuarios concatenados en arrays
        $incidencia->comentarios = $incidencia->comentarios ? explode(',', $incidencia->comentarios) : [];
        $incidencia->usuarios = $incidencia->usuarios ? explode(',', $incidencia->usuarios) : [];

        // Combinar los comentarios y los nombres de usuarios en un solo array
        $incidencia->comentariosUsuarios = [];
        foreach ($incidencia->comentarios as $index => $comentario) {
            $incidencia->comentariosUsuarios[] = [
                'comentario' => $comentario,
                'usuario' => $incidencia->usuarios[$index] ?? 'Anónimo'
            ];
        }
        //debug

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
        // ACTUALIZAR ESTADO DE LA INCIDENCIA
        $incidencia->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('ticket.ticketsGenerales', $incidencia->id)->with('success', 'El estado de la incidencia ha sido actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
