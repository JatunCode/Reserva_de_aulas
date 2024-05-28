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

    public function index(){
        $razones = Razones::all();
        return view('admin.components.formularioRazones', ['razones' => $razones]);
    }

    public function indexList(){
        return Razones::all();
    }

    /**
     * Obtiene una lista de razones que se inserta en una tabla simple
     * @return response 200
     */
    public function store($request){
        $list_ids = [];
        foreach($request as $razon){
            $nueva_razon = new Razones;
            $nueva_razon->razon = $razon;
            $nueva_razon->save();
            $list_ids[] = $nueva_razon->id_razon;
        }
        return $list_ids;
    }
}
