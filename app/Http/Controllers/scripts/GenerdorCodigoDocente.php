<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerdorCodigoDocente extends Controller
{
    public $codigo = "";
    public function Generador(){
        for($i = 0; $i < 3; $i++){
            $this->codigo .= chr(rand(48, 57));
            $this->codigo .= chr(rand(65, 90));
        }
        return $this->codigo;
    }
}
