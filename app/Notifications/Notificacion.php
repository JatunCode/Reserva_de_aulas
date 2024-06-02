<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notificacion extends Notification
{
    use Queueable;

    private $tipo_mensaje;
    private $cuerpo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tipo_mensaje, $cuerpo)
    {   
        $this->tipo_mensaje = $tipo_mensaje;
        $this->cuerpo = $cuerpo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable es la estructura que necesita para mostrar la solicitud, reserva o cancelacion
     *                 debe ser e formato de objeto para poder estructurarlo
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        return (new MailMessage)
                    ->greeting('Buenos dias putaaa C:!!!!')
                    ->line("Su $this->tipo_mensaje ha sido compeltada con exito")
                    ->line("Los datos de su $this->tipo_mensaje son: \n $this->cuerpo")
                    ->line("En caso de haber un error puede cancelar su $this->tipo_mensaje en el siguiente enlace:" )
                    ->action("Cancelar solicitud: ",url('docente/cancelar'))
                    ->action('Ingresar a sus solicitudes.', url('docente/'))
                    ->line('Gracias por usar la aplicacion de reservas!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
