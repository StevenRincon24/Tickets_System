<?php

namespace App\Events;

use App\Models\Incidencia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncidenciaCreada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $incidencia;


    /**
     * Crear una nueva instancia del evento.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return void
     */
    public function __construct(Incidencia $incidencia)
    {
        $this->incidencia = $incidencia;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
