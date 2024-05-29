<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        // $horarios = Horario::with(
        //     'horario_relacion_dahm.dahm_relacion_ambiente',
        //     'horario_relacion_dahm.dahm_relacion_materia',
        //     'horario_relacion_dahm.dahm_relacion_docente')->get();
        $horarios = Relacion_DAHM::with('dahm_relacion_docente.docente_relacion_dahm.dahm_relacion_horario', 'dahm_relacion_materia')->get();
        $horarios_estructurados = [];
        $horarios_docente = [];
        foreach ($horarios as $horario) {
            // foreach($horario['dahm_relacion_docente']['docente_relacion_dahm'] as $value){
            //     $objeto_horario = $value['dahm_relacion_horario'];
            //     $horarios_docente[] = [
            //         'ID' => $objeto_horario['ID_HORARIO'],
            //         'DIA' => $objeto_horario['DIA'],
            //         'INICIO' => $objeto_horario['INICIO'],
            //         'FIN' => $objeto_horario['FIN']
            //     ];
            // }
            $horarios_estructurados[] = [
                'ID' => $horario['dahm_relacion_docente']['ID_DOCENTE'],
                'NOMBRE' => $horario['dahm_relacion_docente']['NOMBRE'],
                'MATERIA' => $horario['dahm_relacion_materia']['NOMBRE'],
                'HORARIOS_DOCENTE' => $horarios_docente
            ];
        }
        return $horarios_estructurados;
        //return view('admin.layouts.horariosModificacion', ['horarios' => $horarios]);
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
    }

    /**
     * Mandara los horarios libres de una aula por api para metodos fetch
     * 
     * @return json_List
     */
    public function indexList($ambiente){
        $horarios = Horario::whereHas(
                'horario_relacion_dahm.dahm_relacion_ambiente',
                function ($query) use ($ambiente){
                    $query->where('ambiente.NOMBRE', $ambiente);
                })->orderBy('INICIO')->get();
        
        $horarios_libres = new GeneradorHorariosNoRegistrados();
        $horarios_nuevo = $horarios_libres->horarios_no_reg("horarios", $horarios, $ambiente);
        return json_encode($horarios_nuevo);
    }

    /**
     * Muestra los horarios con todos los parametros
     *
     * @param  string ambiente
     * @return \Illuminate\Http\Response
     */
    public function showTodo($docente, $dia, $estado)
    {
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  uuid  $id
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
