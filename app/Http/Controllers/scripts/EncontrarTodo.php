<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Docente;
use App\Models\Admin\Materia;
use App\Models\Docente\Razones;

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
     * Encuentra el nombre de la materia segun el id de la materia
     * else
     * Devolvera nada
     * Todos en formato json
     */
    public function getNombreMateria($materia){
        return Materia::where('ID_MATERIA', $materia)->first()->NOMBRE;
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

    /**
     * Encuentra el id del ambiente segun el nombre del ambiente
     * else
     * Devolvera nada
     * Todos en formato json
     */
    public function getNombreAmbiente($id_ambiente){
        return Ambiente::where('ID_AMBIENTE', $id_ambiente)->first()->NOMBRE;
    }

    /**
     * Encuentra el nombre de los docentes por los ids de una solicitud
     * else
     * Devolvera solo el primer nombre
     * Todos en formato json
     */
    public function getNombreDocentesporID($json){
        $iterables = json_decode($json);
        $list = [];
        foreach($iterables as $iterable){
            $docente = Docente::where('ID_DOCENTE', $iterable)->first();
            if(isset($docente)){
                $list[] = [
                    "Nombre_docente" => $docente->NOMBRE
                 ];
            }
        }
        return $list;
    }

    /**
     * Encuentra el nombre de los docentes por los ids de una solicitud
     * else
     * Devolvera solo el primer nombre
     * Todos en formato json
     */
    public function getIdDocentesporNombre($json){
        $iterables = json_decode($json);
        $list = [];
        foreach($iterables as $iterable){
            $list[] = Docente::where('NOMBRE', $iterable)->first()->ID_DOCENTE;
        }
        return json_encode($list);
    }

    /**
     * Encuentra el id de un docente por el nombre del docente
     * else
     * Devolvera solo el primer nombre
     * Todos en formato json
     */
    public function getIdDocenteporNombre($nombre){
        return Docente::where('NOMBRE', $nombre)->first()->ID_DOCENTE;
    }

    /**
     * Encuentra la razon para una reserva por su id
     * Todos en formato json
     */
    public function getRazonesporID($json){
        $iterables = json_decode($json);
        $list = [];
        foreach($iterables as $iterable){
            $list[] = [
               "Razon" => Razones::where('id_razon', $iterable)->first()->RAZON
            ];
        }
        return $list;
    }

    /**
     * Encuentra el id de la razon para una reserva por su razon
     * Todos en formato json
     */
    public function getRazonesporRazon($json){
        $iterables = json_decode($json);
        $list = [];
        foreach($iterables as $iterable){
            $list[] = [
               "Razon" => Razones::where('id_razon', $iterable)->first()->RAZON
            ];
        }
        return $list;
    }
}