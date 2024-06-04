<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Http\Controllers\scripts\GeneradorHorariosNoRegistrados;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Docente;
use App\Models\Admin\Horario;
use App\Models\Admin\Materia;
use App\Models\Admin\Relacion_DAHM;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente',
            'horario_relacion_dahm.dahm_relacion_materia',
            'horario_relacion_dahm.dahm_relacion_docente')->get();
        //return $horarios;
        return view('admin.horarios', ['horarios' => $horarios]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMod()
    {
        $horarios = Docente::select('ID_DOCENTE', 'NOMBRE')
                    ->with([
                        'docente_relacion_dahm' => function ($query) {
                            $query->select('ID_DOCENTE', 'ID_HORARIO', 'ID_AMBIENTE', 'ID_MATERIA')
                                ->with([
                                    'dahm_relacion_horario' => function ($query) {
                                        $query->select('ID_HORARIO', 'DIA', 'INICIO', 'FIN');
                                    }, 
                                    'dahm_relacion_ambiente' => function ($query) {
                                        $query->select('ID_AMBIENTE', 'NOMBRE', 'TIPO');
                                    }
                                ]);
                        },
                        'docente_relacion_materia.dm_relacion_materia' => function ($query) {
                            $query->select('ID_MATERIA', 'NOMBRE');
                        }
                    ])
                    ->get();
        foreach ($horarios as $horario) {
            $horario_materia = $horario['docente_relacion_materia'];
            if(isset($horario_materia)){
                $horarios_docente = [];
                $horarios_materia= [];
                foreach ($horario_materia as $h_materia) {
                    foreach($horario->docente_relacion_dahm as $value){
                        if(isset($value) && $h_materia['ID_MATERIA'] == $value['ID_MATERIA']){
                            $horarios_materia[] = [
                                'ID_HORARIO' => $value['dahm_relacion_horario']['ID_HORARIO'],
                                'DIA' => $value['dahm_relacion_horario']['DIA'],
                                'INICIO' => $value['dahm_relacion_horario']['INICIO'],
                                'FIN' => $value['dahm_relacion_horario']['FIN'],
                                'AMBIENTE' => $value['dahm_relacion_ambiente']['NOMBRE'],
                            ];
                        }
                    }
                    $horarios_docente[] = [
                        'GRUPO_MATERIA' => $h_materia['GRUPO'],
                        'NOMBRE_MATERIA' => $h_materia['dm_relacion_materia']['NOMBRE'],
                        'HORARIOS_MATERIA' => $horarios_materia
                    ];
                }
                $horarios_estructurados[] = [
                    'NOMBRE' => $horario['NOMBRE'],
                    'HORARIOS_DOCENTE' => $horarios_docente
                ];
            }
        }
        return view('admin.layouts.horariosModificacion', ['horarios' => $horarios_estructurados]);
        //return $horarios_estructurados;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFetch()
    {
        $horarios = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente',
            'horario_relacion_dahm.dahm_relacion_materia',
            'horario_relacion_dahm.dahm_relacion_docente')->get();
        return $horarios;
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
            $request->validate([
                'NOMBRE_DOCENTE' => ['required','string', function($attribute, $value, $fail){
                    $nombre = Docente::where('NOMBRE', $value)->first();
                    if(!$nombre){
                        $fail('No existe el docente indicado.');
                    }
                }],
                'MATERIA' => ['required', 'string', function($attribute, $value, $fail){
                    $nombre = Materia::where('NOMBRE', $value)->first();
                    if(!$nombre){
                        $fail('No existe la materia indicada.');
                    }
                }],
                'LISTAS' => 'required'
            ]);
            
            $data = json_decode($request->getContent(), true);
    
            $id_docente = Docente::where('NOMBRE', $data['NOMBRE_DOCENTE'])->value('ID_DOCENTE');
            $id_materia = Materia::where('NOMBRE', $data['MATERIA'])->value('ID_MATERIA');
    
            $data_list = json_decode($data['LISTAS'], true);
            $lista_dias = $data_list["LIST_DIA"];
            $lista_inis = $data_list["LIST_HORAINI"];
            $lista_fins = $data_list["LIST_HORAFIN"];
            $lista_ambientes = $data_list["LIST_AMBIENTE"];
    
            for ($i=0; $i < count($lista_dias); $i++) { 
                $id_ambiente = Ambiente::where('NOMBRE', $lista_ambientes[$i])->value('ID_AMBIENTE');
                $id_horario = Uuid::uuid4();
                if(!$id_ambiente){
                    return redirect()->back()->withInput()->withErrors(['error' => 'No existe el ambiente indicado por favor ingrese uno existente.']);
                }else{
                    Horario::create([
                        'ID_HORARIO' => $id_horario,
                        'INICIO' => $lista_inis[$i],
                        'FIN' => $lista_fins[$i],
                        'DIA' => $lista_dias[$i]
                    ]);
        
                    Relacion_DAHM::create([
                        'ID_RELACION' => Uuid::uuid4(),
                        'ID_DOCENTE' => $id_docente,
                        'ID_AMBIENTE' => $id_ambiente,
                        'ID_HORARIO' => $id_horario,
                        'ID_MATERIA' => $id_materia
                    ]);
                }
            }
            return response()->json(["message" => "Horario creado exitosamente"], 200);
        }
        return view('admin.viewFormHorarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  string ambiente
     * @return \Illuminate\Http\Response
     */
    public function show($ambiente)
    {
        try {
            $horarios = Horario::with(
                'horario_relacion_dahm.dahm_relacion_ambiente',
                'horario_relacion_dahm.dahm_relacion_materia',
                'horario_relacion_dahm.dahm_relacion_docente'
                )->whereHas(
                    'horario_relacion_dahm.dahm_relacion_ambiente',
                    function ($query) use ($ambiente){
                        $query->where('ambiente.NOMBRE', $ambiente);
                    })->orderBy('INICIO')->get();
            return json_encode($horarios);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error al mostrar el horario por ambiente. $th"], 500);
        }
    }

    /**
     * Mandara los horarios libres de una aula por api para metodos fetch
     * 
     * @return json_List
     */
    public function indexList($ambiente){
        try {
            $horarios = Horario::whereHas(
                'horario_relacion_dahm.dahm_relacion_ambiente',
                function ($query) use ($ambiente){
                    $query->where('ambiente.NOMBRE', $ambiente);
                })->orderBy('INICIO')->get();
            
            $horarios_libres = new GeneradorHorariosNoRegistrados();
            $horarios_nuevo = $horarios_libres->horarios_no_reg("horarios", $horarios, $ambiente);
            return json_encode($horarios_nuevo);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error en el servidor al mostrar la lista de horarios por ambiente. $th"], 500);
        }
    }

    /**
     * Muestra los horarios con todos los parametros
     *
     * @param  string ambiente
     * @return \Illuminate\Http\Response
     */
    public function showTodo($docente, $dia, $estado)
    {
        try {
            $horarios = Horario::with(
                'horario_relacion_dahm.dahm_relacion_ambiente',
                'horario_relacion_dahm.dahm_relacion_materia',
                'horario_relacion_dahm.dahm_relacion_docente'
                )->whereHas(
                    'horario_relacion_dahm.dahm_relacion_ambiente',
                    function ($query) use ($dia, $estado) {
                        if($dia != " "){
                            $query->where('DIA', $dia);
                        }
                        if($estado != " "){
                            $query->where('ambiente.ESTADO', $estado);
                        }
                    }
                )->whereHas(
                    'horario_relacion_dahm.dahm_relacion_docente',
                    function ($query) use ($docente){
                        if($docente != " "){
                            $query->where('docente.NOMBRE', $docente);
                        }
                    }
                )->orderBy('INICIO')->get();
            return json_encode($horarios);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error en el servidor al mostrar la lista de horarios filtrados. $th"], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  uuid  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $buscador = new EncontrarTodo();
        try {
            $horarios = json_decode($request->getContent(), true);
            foreach($horarios as $horario){
                $update = Horario::where('ID_HORARIO', $horario['ID_HORARIO']);
                $update->update([
                    'DIA' => $horario['DIA'],
                    'INICIO' => $horario['INICIO'],
                    'FIN' => $horario['FIN']
                ]);
                $update = Relacion_DAHM::where('ID_HORARIO', $horario['ID_HORARIO']);
                $update->update(['ID_AMBIENTE' => $buscador->getIdAmbiente($horario['AMBIENTE'])]);
            }
            return response()->json(['message' => 'Actualizacion de horario exitosa.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error en el servidor al actualizar el horario. $th"], 500);
        }
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
