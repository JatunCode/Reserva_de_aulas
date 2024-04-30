<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente\Razones;

class RazonesController extends Controller
{
    public function borrarRazon($id)
    {
        // Encuentra la razón por su ID
        $razon = Razones::findOrFail($id);

        // Borra la razón de la base de datos
        $razon->delete();

        // Devuelve la razón borrada como JSON
        return response()->json(['message' => 'Razón borrada exitosamente']);
    }
}
