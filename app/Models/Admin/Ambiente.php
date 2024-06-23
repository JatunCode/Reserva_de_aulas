<?php

namespace App\Models\Admin;

use App\Models\Docente\Solicitud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    protected $table = 'ambiente';
    protected $primaryKey = 'ID_AMBIENTE';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['ID_AMBIENTE', 'TIPO', 'NOMBRE', 'REFERENCIAS', 'CAPACIDAD', 'DATA', 'ESTADO'];
    /**
     * funciones relacionales
     */
    public function ambiente_relacion_dahm(){
        return $this->hasMany(Relacion_DAHM::class, 'ID_AMBIENTE', 'ID_AMBIENTE');
    }

    public function ambiente_relacion_solicitud(){
        return $this->belongsTo(Solicitud::class, 'ID_AMBIENTE', 'ID_AMBIENTE');
    }
}
