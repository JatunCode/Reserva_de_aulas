<?php

namespace App\Models\Docente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reserva';
    protected $fillable = ['ID_RESERVA', 'ID_SOLICITUD', 'FECHAHORA_RESER'];
}



