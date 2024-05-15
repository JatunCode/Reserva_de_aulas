<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Horario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return view('admin.ambientes', ['ambientes' => $ambientes]);
    }

    /**
     * Devuelve una lista de ambientes para la peticion de busqueda fetch
     */

    public function indexList()
    {
        $ambientes = Ambiente::all();
        return json_encode($ambientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $uuid = Uuid::uuid4();
            $request->validate([
                'TIPO' => 'required|string|max:10',
                'NOMBRE' => 'required|string|max:50',
                'REFERENCIAS' => ['required', function($attribute, $value, $fail){
                    $decoder = json_decode($value, true);
                    if(!is_array($decoder) || count($decoder) < 1 || count($decoder) > 4){
                        $fail($attribute.' debe contener entre 1 y 4 referencias.');
                    }
                }],
                'CAPACIDAD' => 'required|integer',
                'DATA' => ['required', 'string', Rule::in(['SI', 'NO'])]
            ]);
            
            Ambiente::create([
                'ID_AMBIENTE' => $uuid->toString(),
                'TIPO' => $request->TIPO,
                'NOMBRE' => $request->NOMBRE,
                'REFERENCIAS' => json_encode($request->REFERENCIAS),
                'CAPACIDAD' => $request->CAPACIDAD,
                'DATA' => $request->DATA,
                'ESTADO' => 'HABILITADO'
            ]);
            return response()->json(["message" => "Ambiente creado exitosamente"], 200);
        }
        return view('admin.viewFormAmbientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
        $value = Ambiente::where('NOMBRE', $nombre)->first();
        if(!$value){
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }
        //return view('search.ambiente');
        return response()->json(['message' => 'Ambiente encontrado', 'data' => $value], 200);
        
    }

    /**
     * Muestra a los ambientes por dia para las peticiones fetch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAmbiente($nombre, $dia, $estado)
    {
        $value = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente'
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_ambiente', 
                function ($query) use ($dia, $nombre, $estado){
                    $query->where('DIA', $dia);
                    $query->where('ambiente.NOMBRE', $nombre);
                    $query->where('ambiente.ESTADO', $estado);
                }
            )->get();
        return $value;
    }

    /**
     * Muestra a los ambientes por dia para las peticiones fetch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMateria($materia, $dia, $estado)
    {
        $value = Horario::with(
            'horario_relacion_dahm.dahm_relacion_materia',
            'horario_relacion_dahm.dahm_relacion_ambiente'
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_materia', 
                function ($query) use ($dia, $materia){
                    $query->where('DIA', $dia);
                    $query->where('materia.NOMBRE', $materia);
                }
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_ambiente',
                function ($query) use ($estado){
                    $query->where('ambiente.ESTADO', $estado);
                }
            )->get();
        return $value;
    }

    /**
     * Muestra a los ambientes por dia para las peticiones fetch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTodo($ambiente, $materia, $dia, $estado)
    {
        $value = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente',
            'horario_relacion_dahm.dahm_relacion_materia'
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_ambiente', 
                function ($query) use ($ambiente, $dia, $estado){
                    $query->where('DIA', $dia);
                    $query->where('ambiente.NOMBRE', $ambiente);
                    $query->where('ambiente.ESTADO', $estado);
                }
            )->whereHas(
                'horario_relacion_dahm.dahm_relacion_materia',
                function ($query) use ($materia){
                    $query->where('materia.NOMBRE', $materia);
                }
            )->get();
        return $value;
    }

    /**
     * Muestra a los ambientes por dia para las peticiones fetch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSin($dia, $estado)
    {
        $value = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente',
            'horario_relacion_dahm.dahm_relacion_materia'
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_ambiente', 
                function ($query) use ($dia, $estado){
                    $query->where('DIA', $dia);
                    $query->where('ambiente.ESTADO', $estado);
                }
            )->get();
        return $value;
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
