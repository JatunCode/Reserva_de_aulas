<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';
    protected $fillable = ['ID_DOCENTE', 'NOMBRE', 'GRUPO', 'CELULAR', 'EMAIL'];
    
    public function docente_relacion_dahm(){
        return $this->hasOne(Relacion_DAHM::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }

    public function notificaion_relacion_docente(){
        return $this->belongsTo(Notificacion::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}




