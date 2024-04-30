<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;

class GeneradorHorariosNoRegistrados extends Controller
{
    public function horarios_no_reg($horarios){
        $lista_horarios_no_reg = [];
        $dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
        foreach ($dias as $dia) {
            $lista_horarios_no_reg[] = $this->porDia($this->obtenerHorasPorDia($horarios, $dia));
        }
        return $lista_horarios_no_reg;
    }

    private function porDia($horas){
        $hora_ini= 24300;
        $hora_fin = 78300;
        $list = [];
        foreach ($horas as $hora) {
            $rango = $this->verificarRango($horas);
            while($hora_ini <= $hora_fin){
                if($hora_ini != strtotime($hora['INICIO']) - strtotime($hora['FIN'])){
                    $list[] = [
                        'DIA' => $hora['DIA'],
                        'HORA_INI' => $hora_ini,
                        'HORA_FIN' => $hora_ini+$rango,
                        'AMBIENTE' => $hora['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE']
                    ];
                }
                $hora_ini += $rango;
            }
        }
        return $list;
    }

    private function obtenerHorasPorDia($horas, $dia){
        $list = [];
        foreach ($horas as $hora) {
            if($hora['DIA'] == $dia){
                $list[] = $hora;
            }
        }
        return $list;
    }

    private function verificarRango($horas){
        $aux = 0;
        foreach ($horas as $hora) {
            $var = strtotime($hora['INICIO']) - strtotime($hora['FIN']);
            if($aux <= $var){
                $aux = $var;
            }
        }
        return $aux;
    }
}


