<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horario';
    protected $fillable = ['ID_HORARIO', 'INICIO', 'FIN', 'DIA'];

    function horario_relacion_dahm(){
        return $this->hasOne(Relacion_DAHM::class, 'ID_HORARIO', 'ID_HORARIO');
    }
}



