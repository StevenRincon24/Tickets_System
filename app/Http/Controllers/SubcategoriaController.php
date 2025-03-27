<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubcategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Subcategoria::with('categoria')->get());
    }


    public function create()
    {
        return Inertia::render('SubCategorias/Create', [
            'categorias' => Categoria::all(),

        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|array|min:1',
            'nombres.*' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        foreach ($request->nombres as $nombre) {
            Subcategoria::create([
                'nombre' => $nombre,
                'categoria_id' => $request->categoria_id,
            ]);
        }


        return back()->with('success', 'Actividades registradas correctamente.');
    }



    public function show($id)
    {
        $subcategoria = Subcategoria::with('categoria')->find($id);
        if (!$subcategoria) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }
        return response()->json($subcategoria);
    }

    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::find($id);
        if (!$subcategoria) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'required|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $subcategoria->update($request->only('nombre', 'categoria_id'));

        return response()->json($subcategoria);
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::find($id);
        if (!$subcategoria) {
            return response()->json(['message' => 'Subcategoría no encontrada'], 404);
        }

        $subcategoria->delete();

        return response()->json(['message' => 'Subcategoría eliminada correctamente']);
    }
}
