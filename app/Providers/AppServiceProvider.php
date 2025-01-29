<?php

namespace App\Providers;

use App\Events\IncidenciaCreada;
use App\Listeners\CrearNotificacionParaIncidencia;
use App\Models\Incidencia;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        // Registrar el evento y su listener
        IncidenciaCreada::class => [
            CrearNotificacionParaIncidencia::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share('incidenciasPendientes', function () {
            return Incidencia::where('estado', 'Pendiente')->count();
        });
    }
}
