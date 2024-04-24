<?php

namespace App\Models\Docente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reserva';
    protected $primaryKey = 'ID_RESERVA'; // Especifica la clave primaria si no es 'id'
    protected $fillable = [ 'ID_SOLICITUD', 'FECHAHORA_RESER'];

    public function reserva_relacion_solicitud(){
        return $this->hasOne(Solicitud::class, 'ID_SOLICITUD', 'ID_SOLICITUD');
    }
}



