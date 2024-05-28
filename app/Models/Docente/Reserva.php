<?php

namespace App\Models\Docente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reserva';
    protected $fillable = ['ID_RESERVA', 'ID_SOLICITUD', 'RAZONES', 'FECHAHORA_RESER'];

    public function reserva_relacion_solicitud(){
        return $this->hasOne(Solicitud::class, 'ID_SOLICITUD', 'ID_SOLICITUD');
    }
}



