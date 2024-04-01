<?php

namespace App\Models\Docente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = [
        'nombre',
        'nombre1',
        'nombre2',
        'nombre3',
        'nombre4',
        'nombre5',
        'materia',
        'grupo',
        'cantidad_estudiantes',
        'motivo',
        'modo',
        'razon',
        'aula',
        'fecha',
        'horario',
        'estado',
    ];
}