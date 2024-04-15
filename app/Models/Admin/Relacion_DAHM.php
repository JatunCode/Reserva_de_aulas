<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion_DAHM extends Model
{
    use HasFactory;
    protected $table = "relacion_dahm";
    protected $fillable = ['ID_RELACION'. 'ID_DOCENTE', 'ID_AMBIENTE', 'ID_HORARIO', 'ID_MATERIA'];

    public function dahm_relacion_horario(){
        return $this->belongsTo(Horario::class, 'ID_HORARIO', 'ID_HORARIO');
    }

    public function dahm_relacion_ambiente(){
        return $this->hasOne(Ambiente::class, 'ID_AMBIENTE', 'ID_AMBIENTE');
    }

    public function dahm_relacion_materia(){
        return $this->hasOne(Materia::class, 'ID_MATERIA', 'ID_MATERIA');
    }

    public function dahm_relacion_docente(){
        return $this->hasOne(Docente::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}
