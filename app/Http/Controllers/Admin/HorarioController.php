<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Docente;
use App\Models\Admin\Horario;
use App\Models\Admin\Materia;
use App\Models\Admin\Relacion_DAHM;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use function PHPSTORM_META\map;

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
            'relacion_materia_horario.dahm_relacion_ambiente',
            'relacion_materia_horario.dahm_relacion_materia',
            'relacion_materia_horario.dahm_relacion_docente')->get();
        //return $horarios;
        return view('admin.horarios', ['horarios' => $horarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return redirect()->route('admin.horarios')->with('success', 'Horario creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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