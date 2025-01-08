<?php

namespace App\Http\Controllers;


use App\Models\TipoIncidencias;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TipoIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('TipoIncidencia/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',

        ]);


        TipoIncidencias::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->back()->with('success', 'Tipo de incidencia registrada.');
    }

    /**
     * Display the specified resource.
     */
}
