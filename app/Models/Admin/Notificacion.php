<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = 'notificacion';
    protected $fillable = ['ID_NOTIFICACION', 'CUERPO', 'ID_DOCENTE'];

    public function docente_relacion_notificacion(){
        return $this->hasOne(Docente::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}
