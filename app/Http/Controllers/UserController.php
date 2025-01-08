<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia('Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    { {

            // Validar datos
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|exists:roles,name', // Validar que el rol exista

            ]);

            // Crear usuario
            $user = User::create([
                'name' => $validated['nombre'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            $user->assignRole($validated['role']);

            // Retornar respuesta
            return back()->with('success', 'Usuario registrado exitosamente.');
        }
    }
}
