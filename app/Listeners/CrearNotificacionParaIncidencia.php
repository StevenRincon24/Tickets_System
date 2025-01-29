<?php

namespace App\Listeners;

use App\Events\IncidenciaCreada;
use App\Models\Notificaciones_Incidencia;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CrearNotificacionParaIncidencia
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Manejar el evento.
     *
     * @param  \App\Events\IncidenciaCreada  $event
     * @return void
     */
    public function handle(IncidenciaCreada $event)
    {
        // Obtener la incidencia del evento
        $incidencia = $event->incidencia;

        // Crear la notificación
        Notificaciones_Incidencia::create([
            'incidencia_id' => $incidencia->id,
            'user_id' => $incidencia->user_id,
            'dependencia_id' => $incidencia->dependencia_id,
            'leido' => false,
        ]);
    }
}
