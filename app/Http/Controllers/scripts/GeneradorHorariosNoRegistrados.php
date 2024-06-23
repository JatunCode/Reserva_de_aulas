<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;

class GeneradorHorariosNoRegistrados extends Controller
{
    public function horarios_no_reg($tipo, $horarios, $ambiente){
        $lista_horarios_no_reg = [];
        $dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
        if($tipo == "horarios"){
            foreach ($dias as $dia) {
                $lista_horarios_no_reg[] = $this->porDia($this->obtenerHorasPorDia($horarios, $dia), $dia, $ambiente);
            }
        }else if($tipo == "solicitudes"){
            $lista_horarios_no_reg = $this->porDia($this->obtenerHorasPorDia($horarios['arreglo'], $this->cambiarADiaEspañol($horarios['dia'])), $this->cambiarADiaEspañol($horarios['dia']), $ambiente);
        }
        return $lista_horarios_no_reg;
    }

    private function porDia($horas, $dia, $ambiente){
        $hora_ini= 24300;
        $hora_fin = 78300;
        $list = [];
        $rango = (!empty($horas)) ? $this->verificarRango($horas) : 5400;
        $horas_eliminar = $horas;
        $hora_nose = array_shift($horas_eliminar);
        while($hora_ini < $hora_fin){
            if(count($horas) == 0){
                $list[] = [
                    'DIA' => $dia,
                    'HORA_INI' => date('H:i',$hora_ini),
                    'HORA_FIN' => date('H:i',$hora_ini+$rango),
                    'AMBIENTE' => $ambiente
                ];
            }else{
                if($hora_nose['INICIO'] != date('H:i', $hora_ini)){
                    $list[] = [
                        'DIA' => $dia,
                        'HORA_INI' => date('H:i',$hora_ini),
                        'HORA_FIN' => date('H:i',$hora_ini+$rango),
                        'AMBIENTE' => $ambiente
                    ];
                }else{
                    $hora_nose = array_shift($horas_eliminar);
                    array_shift($horas);
                }
            }
            $hora_ini += $rango;
        }
        return $list;
    }

    private function obtenerHorasPorDia($horas, $dia){
        $list = [];
        foreach ($horas as $hora) {
            $dia_cambio = (strpos($hora['DIA'], "y")) ? $this->cambiarADiaEspañol($hora['DIA']) : $hora['DIA'];
            if($dia_cambio == $dia){
                $list[] = $hora;
            }
        }
        return $list;
    }

    private function verificarRango($horas){
        $aux = 0;
        foreach ($horas as $hora) {
            $var = strtotime($hora['FIN']) - strtotime($hora['INICIO']);
            if($aux <= $var){
                $aux = $var;
            }
        }
        return $aux;
    }

    private function cambiarADiaEspañol($dia){
        $dias = [
            'LUNES' => 'monday',
            'MARTES' => 'tuesday',
            'MIERCOLES' => 'wednesday',
            'JUEVES' => 'thursday',
            'VIERNES' => 'friday',
            'SABADO' => 'saturday'
        ];

        return array_search(strtolower($dia), $dias);
    }
}



