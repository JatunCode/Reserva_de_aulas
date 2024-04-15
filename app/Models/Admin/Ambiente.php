<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    protected $table = 'ambiente';
    protected $fillable = ['ID_AMBIENTE', 'TIPO', 'NOMBRE', 'REFERENCIAS', 'CAPACIDAD', 'DATA', 'ESTADO'];
    /**
     * funciones relacionales
     */
    public function ambiente_relacion_dahm(){
        return $this->hasMany(Relacion_DAHM::class, 'ID_AMBIENTE', 'ID_AMBIENTE');
    }
}
