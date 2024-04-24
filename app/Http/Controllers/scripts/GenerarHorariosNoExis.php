<?php


function horarios_no_reg($horarios_ambiente){
    $fecha_ini= strtotime(date('Y-m-d'));
    $fecha_fin = strtotime('+1week', $fecha_ini);
    $lista_horarios_no_reg = [];
    foreach ($horarios_ambiente as $value) {
        
    }
    return $lista_horarios_no_reg;
}