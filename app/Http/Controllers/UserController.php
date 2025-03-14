<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with(['roles', 'dependencia'])->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia('Users/Create', [
            'roles' => $roles,
            'dependencias' => Dependencia::all(),
        ]);
    }

    public function store(Request $request)
    { {

            // Validar datos
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|exists:roles,name',
                'dependencia_id' => 'required|exists:dependencias,id', // Validar que la dependencia exista

            ]);

            // Crear usuario
            $user = User::create([
                'name' => $validated['nombre'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'dependencia_id' => $validated['dependencia_id'], // Asignar dependencia
            ]);

            $user->assignRole($validated['role']);

            // Retornar respuesta
            return back()->with('success', 'Usuario registrado exitosamente.');
        }
    }

    // FUNCION PARA REALIZAR EL CAMBIO DE CONTRASEÑA
    public function editPassword(Request $request, User $user)
    {

        // Validar los datos del request (opcional, pero recomendado)
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // Validar que el password sea seguro y que se confirme
        ]);

        // Habilitar el registro de consultas para depuración
        DB::enableQueryLog();

        // Modificar la contraseña del usuario recibido como argumento
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Obtener las consultas ejecutadas para depuración (opcional)


        // Redireccionar con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'La contraseña del usuario ha sido actualizada correctamente.');
    }
}
