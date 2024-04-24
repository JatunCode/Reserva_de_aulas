<?php

namespace App\Models\Docente;

use App\Models\Admin\Ambiente;
use App\Models\Admin\Materia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitud';
    protected $fillable = ['ID_SOLICITUD', 'ID_DOCENTE_s', 'CANTIDAD_EST', 'FECHA_RE', 'HORAINI', 'HORAFIN', 'FECHAHORA_SOLI', 'MOTIVO', 'PRIORIDAD', 'ID_MATERIA', 'GRUPOS', 'ID_AMBIENTE', 'ESTADO'];

    public function solicitud_relacion_reserva(){
        return $this->belongsTo(Reserva::class, 'ID_SOLICITUD', 'ID_SOLICITUD');
    }

    public function solicitud_relacion_materia(){
        return $this->hasOne(Materia::class, 'ID_MATERIA', 'ID_MATERIA');
    }

    public function solicitud_relacion_ambiente(){
        return $this->hasOne(Ambiente::class, 'ID_AMBIENTE', 'ID_AMBIENTE');
    }
}
