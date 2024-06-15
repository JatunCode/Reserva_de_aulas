<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Devolvera a la lista de api para los fetch de busquedas
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return json_encode($docentes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($caracter)
    {
        $docente = Docente::where('NOMBRE', 'LIKE', "%$caracter%")->get();
        return json_encode($docente);
    }

    /**
     * Muestra los docentes con sus materias y grupos correspondientes
     * 
     * @return Json
     */
    public function showDocentesMaterias(){
        $docentes = Docente::select('ID_DOCENTE', 'NOMBRE')
            ->with([
                'docente_relacion_materia.dm_relacion_materia' => function ($query) {
                    $query->select('ID_MATERIA', 'NOMBRE');
                }
            ])->get();
        $docentes_estructurados = [];
        
        foreach ($docentes as $docente) {
            $materias_estructuradas = [];
            if(isset($docente)){
                $materias = $docente['docente_relacion_materia'];
                foreach ($materias as $materia) {
                    $materias_estructuradas [] = [
                        'GRUPO' => $materia['GRUPO'],
                        'ID_MATERIA' => $materia['dm_relacion_materia']['ID_MATERIA'],
                        'NOMBRE' => $materia['dm_relacion_materia']['NOMBRE'],
                    ];
                }
                $docentes_estructurados [] = [
                    'NOMBRE_DOCENTE' => $docente['NOMBRE'],
                    'MATERIAS' => $materias_estructuradas
                ];
            }
        }
        //return $docentes;
        return $docentes_estructurados;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
