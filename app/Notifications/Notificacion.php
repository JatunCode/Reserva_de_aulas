<?php

namespace App\Notifications;

use App\Http\Controllers\scripts\EncontrarTodo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;

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
        $this->tipo_mensaje = strtolower($tipo_mensaje);
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
        $buscador = new EncontrarTodo();
        $razones = implode(", ", $buscador->getRazonesporID($this->cuerpo['RAZONES']));

        $saludos = ["BUENOS DÌAS", "BUENAS TARDES", "BUENAS NOCHES"];
        $saludo = "";

        $hora_actual = Date::now()->format('H');
        if ($hora_actual >= 6 && $hora_actual < 12) {
            $saludo = $saludos[0]; 
        } elseif ($hora_actual >= 12 && $hora_actual < 18) {
            $saludo = $saludos[1]; 
        } else {
            $saludo = $saludos[2];
        }

        $mensajes_tipo_solicitud = ["Su $this->tipo_mensaje ha sido completada con exito.", "Su $this->tipo_mensaje ha sido aceptada.", "Sentimos que su $this->tipo_mensaje haya sido rechazada."];
        $mensaje_inicial = "";

        if($this->tipo_mensaje != "reserva"){
            $mensaje_inicial = $mensajes_tipo_solicitud[0];
        }else if($this->cuerpo['ESTADO'] == 'ACEPTADO'){
            $mensaje_inicial = $mensajes_tipo_solicitud[1];
        }else{
            $mensaje_inicial = $mensajes_tipo_solicitud[2];
        }

        $mensajes_datos = ["Hora de reserva: ".$this->cuerpo['FECHA'], "Razones de cancelacion: "];
        $mensaje_dato = "";

        $mensajes_info = ["En caso de haber un error puede cancelar su $this->tipo_mensaje en el siguiente enlace:", "$razones"];
        $mensaje_info = "";

        $mensajes_accion = [
            [
                'message' => "Cancelar $this->tipo_mensaje", 
                'url' => "admin/reservas/atencion"
            ], 
            [
                'message' => "Nueva solicitud", 
                'url' => "admin/solicitud"]];
        $mensaje_accion = null;

        if($this->tipo_mensaje != "reserva" || $this->cuerpo['ESTADO'] == 'ACEPTADO'){
            $mensaje_dato = $mensajes_datos[0];
            $mensaje_info = $mensajes_info[0];
            $mensaje_accion = $mensajes_accion[0];
        }else{
            $mensaje_dato = $mensajes_datos[1];
            $mensaje_info = $mensajes_info[1];
            $mensaje_accion = $mensajes_accion[1];
        }

        return (new MailMessage)
                    ->greeting("$saludo ".$this->cuerpo['NOMBRE'])
                    ->level((!isset($this->cuerpo['ESTADO']) || $this->cuerpo['ESTADO'] == 'ACEPTADO') ? 'error':'success')
                    ->line($mensaje_inicial)
                    ->line("Los datos de su $this->tipo_mensaje son:")
                    ->line("Materia: ".$this->cuerpo['MATERIA'])
                    ->line("Ambiente de reserva: ".$this->cuerpo['AMBIENTE'])
                    ->line($mensaje_dato)
                    ->line($mensaje_info)
                    ->action($mensaje_accion['message'],url($mensaje_accion['url']))
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
