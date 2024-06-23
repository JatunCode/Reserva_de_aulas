<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacion_DM extends Model
{
    use HasFactory;
    protected $table = 'relacion_dm';
    protected $primaryKey = 'ID_RELACION';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['ID_RELACION', 'ID_DOCENTE', 'ID_MATERIA', 'GRUPO'];

    function  dm_relacion_materia(){
        return $this->belongsTo(Materia::class, 'ID_MATERIA', 'ID_MATERIA');
    }

    function dm_relacion_docente(){
        return $this->hasOne(Docente::class, 'ID_DOCENTE', 'ID_DOCENTE');
    }
}

