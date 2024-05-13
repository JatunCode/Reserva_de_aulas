<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Docente;
use App\Models\Admin\Materia;
use Illuminate\Http\Request;

class EncontrarTodo extends Controller
{
    /**
     * Encuentra el id y grupos del docente si es uno
     * else
     * Devolvera los ids y grupos de los docentes en el arreglo
     * Todos en formato json
     */
    public function getGruposyIdsDocentes($nombres){
        $ids_docentes = [];
        $grupos = [];
        foreach ($nombres as $nombre) {
            $docente = Docente::where('NOMBRE', $nombre)->first();
            $ids_docentes[] = $docente->ID_DOCENTE;
            $grupos[] = $docente->GRUPO;
        }
        return array(json_encode($ids_docentes),json_encode($grupos));
    }

    /**
     * Encuentra el id de la materia segun el nombre de la materia
     * else
     * Devolvera nada
     * Todos en formato json
     */
    public function getIdMateria($materia){
        return Materia::where('NOMBRE', $materia)->first()->ID_MATERIA;
    }

    /**
     * Encuentra el id del ambiente segun el nombre del ambiente
     * else
     * Devolvera nada
     * Todos en formato json
     */
    public function getIdAmbiente($ambiente){
        return Ambiente::where('NOMBRE', $ambiente)->first()->ID_AMBIENTE;
    }
}
