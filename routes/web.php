<?php

use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoIncidenciaController;
use App\Models\TipoIncidencia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn() => Inertia::render('About'))->name('about');

    Route::get('/ticketcreate', [IncidenciaController::class, 'create'])->name('ticket.create');
    Route::post('/ticketcreate', [IncidenciaController::class,'store'])->name('storeIncidencia');
    Route::get('/tickets', [IncidenciaController::class, 'index'])->name('ticket.index');
    Route::get('/ticketsGenerales', [IncidenciaController::class, 'incidenciasGenerales'])->name('ticket.ticketsGenerales')->middleware('can:Tickets generales');
    Route::get('/verTicket/{incidencia}', [IncidenciaController::class, 'show'])->name('ticket.show');

    // LISTA DE RUTAS PARA USUARIOS
    Route::get('/addUser', [UserController::class, 'create'])->name('users.create');
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('can:ver usuario');;
    Route::post('users', [UserController::class, 'store'])->name('storeUsers');

    // LISTA DE RUTAS PARA DEPENDENCIAS
    Route::get('/addDependencia', [DependenciaController::class, 'create'])->name('dependencias.create');
    Route::get('dependencias', [DependenciaController::class, 'index'])->name('dependencias.index');
    Route::post('dependencias', [DependenciaController::class, 'store'])->name('storeDependencias');
    Route::put('/dependencias/{dependencia}', [DependenciaController::class, 'update'])->name('dependencias.update');



    Route::get('/profileedit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
