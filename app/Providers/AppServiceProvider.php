<?php

namespace App\Providers;

use App\Models\Incidencia;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

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
