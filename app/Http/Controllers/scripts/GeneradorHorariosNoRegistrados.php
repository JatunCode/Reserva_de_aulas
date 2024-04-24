<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneradorHorariosNoRegistrados extends Controller
{
    function horarios_no_reg(){
        $fecha_ini= strtotime(date('Y-m-d'));
        $fecha_fin = strtotime('+1day', $fecha_ini);
        $lista_horarios_no_reg = [];
        foreach ($horarios_ambiente as $value) {
            
        }
        return $lista_horarios_no_reg;
    }
}
