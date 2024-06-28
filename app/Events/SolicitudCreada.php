<?php

namespace App\Events;

use App\Models\Docente\Solicitud;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SolicitudCreada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $count_solis_pendientes = 0;
    public int $count_solis_pend_urgentes = 0;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $conteos = $this->countsSolicitudes();
        $this->count_solis_pendientes = $conteos[0];
        $this->count_solis_pend_urgentes = $conteos[1];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * Contar las solicitudes pendientes
     * Contar las solicitudes pendientes urgentes
     * @return array
     */
    private function countsSolicitudes(){
        $solicitudes = Solicitud::where('ESTADO', 'PENDIENTE');
        return [
            $solicitudes->count(),
            $solicitudes->where('PRIORIDAD', 'LIKE', "%URGENTE%")->count()
        ];
    }
}
