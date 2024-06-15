<?php

namespace App\Models\Admin;

use App\Models\Docente\Solicitud;
use Facade\IgnitionContracts\Solution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materia';
    protected $fillable = ['ID_MATERIA', 'NOMBRE', 'TIPO'];

    public function materia_relacion_dahm(){
        return $this->hasOne(Relacion_DAHM::class, 'ID_MATERIA', 'ID_MATERIA');
    }
    
    public function materia_relacion_solicitud(){
        return $this->belongsTo(Solicitud::class, 'ID_MATERIA', 'ID_MATERIA');
    }

    public function materia_relacion_dm(){
        return $this->hasMany(Relacion_DM::class, 'ID_MATERIA', 'ID_MATERIA');
    }
}
