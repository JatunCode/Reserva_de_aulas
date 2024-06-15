<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Docente;
use App\Models\Admin\Materia;
use App\Models\Admin\Relacion_DM;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Materia::all(['NOMBRE']);
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
    public function show($nombre)
    {
        $materias_docente = Docente::with(
            'docente_relacion_dahm.dahm_relacion_materia'
        )->whereHas('docente_relacion_dahm.dahm_relacion_materia', 
                function ($query) use ($nombre){
                    $query->where('docente.NOMBRE', 'LIKE', "%$nombre%");
                })->get();

        return json_encode($materias_docente);
    }

    public function showMateriasGrupos(){
        $materias = Materia::with('materia_relacion_dm')->get();
        $materias_estreucturadas = [];
        foreach ($materias as $materia) {
            $grupos = [];
            if(isset($materia)){
                foreach ($materia['materia_relacion_dm'] as $grupo) {
                    $grupos[] = [
                        'GRUPO' => $grupo['GRUPO'],
                    ];
                }
                $materias_estreucturadas []= [
                    'ID_MATERIA' => $materia['ID_MATERIA'],
                    'GRUPO' => $grupos,
                    'NOMBRE' => $materia['NOMBRE']
                ];
            }
        }
        return $materias_estreucturadas;
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
