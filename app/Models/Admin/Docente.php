<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'docente';
    protected $fillable = ['ID_DOCENTE', 'NOMBRE', 'CELULAR', 'EMAIL'];
    
    public function docente_relacion_dahm(){
        return $this->hasMany(Relacion_DAHM::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }

    public function notificaion_relacion_docente(){
        return $this->belongsTo(Notificacion::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }

    public function docente_relacion_materia(){
        return $this->hasMany(Relacion_DM::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}




