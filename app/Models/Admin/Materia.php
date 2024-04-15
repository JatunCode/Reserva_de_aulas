<?php

namespace App\Models\Admin;

use App\Models\Docente\Solicitud;
use Facade\IgnitionContracts\Solution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materia';
    protected $fillable = ['ID_MATERIA', 'NOMBRE', 'TIPO'];

    
    public function materia_relacion_solicitud(){
        return $this->belongsTo(Solicitud::class, 'ID_MATERIA', 'ID_MATERIA');
    }
}
