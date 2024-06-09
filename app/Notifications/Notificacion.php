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
        // $data = [
        //     'tipo_mensaje' => $this->tipo_mensaje,
        //     'cuerpo' => $this->cuerpo,
        //     'cancelar_url' => url('docente/cancelar'),
        //     'accion1_url' => url('docente/accion1'),
        //     'accion2_url' => url('docente/accion2'),
        // ];
    
        // $html = view('admin.mail.notificacion', $data)->render();
    
        // return (new MailMessage)
        //     ->subject('Asunto del Correo')
        //     ->view($html, $data);
        $mensajes = [""];
        return (new MailMessage)
                    ->greeting("Buenos dias ".$this->cuerpo['NOMBRE'])
                    ->level((!isset($this->cuerpo['ESTADO']) || $this->cuerpo['ESTADO'] == 'ACEPTADO') ? 'error':'success')
                    ->line("Su $this->tipo_mensaje ha sido completada con exito")
                    ->line("Los datos de su $this->tipo_mensaje son:")
                    ->line("Hora de reserva: ".$this->cuerpo['FECHA'])
                    ->line("Materia: ".$this->cuerpo['MATERIA'])
                    ->line("Ambiente de reserva: ".$this->cuerpo['AMBIENTE'])
                    ->line("En caso de haber un error puede cancelar su $this->tipo_mensaje en el siguiente enlace:" )
                    ->action("Cancelar $this->tipo_mensaje",url('docente/cancelar'))
                    ->line('Gracias por usar nuestra aplicacion de reservas!');
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
