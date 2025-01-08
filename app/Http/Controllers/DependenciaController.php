<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dependencias/Index', [
            'dependencias' => Dependencia::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dependencias/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "nombre" => 'required|string|max:255',
        ]);

        Dependencia::create($validated);

        return back()->with('success', 'Dependencia registrada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dependencia $dependencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dependencia $dependencia)
    {
        return Inertia::render('Dependencias/Edit', [
            'dependencia' => $dependencia  // Pasa la dependencia que se va a editar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dependencia $dependencia)
    {


        $validated = $request->validate([
            "nombre" => 'required|string|max:255',
        ]);

        $dependencia->update($validated);

        return redirect()->route('dependencias.index')->with('success', 'Dependencia actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dependencia $dependencia)
    {
        
    }
}
