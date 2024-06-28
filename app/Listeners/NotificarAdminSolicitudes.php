<?php

namespace App\Listeners;

use App\Events\SolicitudCreada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificarAdminSolicitudes
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SolicitudCreada  $event
     * @return void
     */
    public function handle(SolicitudCreada $event)
    {
        //
    }
}
