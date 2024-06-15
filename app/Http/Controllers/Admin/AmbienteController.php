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
        $ambientes_estructurados = [];
        foreach ($ambientes as $ambiente) {
            $ambientes_estructurados [] = [
                'NOMBRE' => $ambiente['NOMBRE'],
                'TIPO' => $ambiente['TIPO'],
                'REFERENCIAS' => ''.$this->quitarCaracteres($ambiente['REFERENCIAS']),
                'CAPACIDAD' => $ambiente['CAPACIDAD'],
                'DATA' => $ambiente['DATA'],
                'ESTADO' => $ambiente['ESTADO'] 
            ];
        }
        return view('admin.listar.ambientes', ['ambientes' => $ambientes_estructurados]);
    }

    function quitarCaracteres($input) {
        $regex = '/[^a-zA-Z0-9, ]/';
        $cadena = preg_replace($regex, '', $input);
        return $cadena;
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
            return response()->json(['message' => 'Ambiente creado exitosamente'], 200);
        }
        return view('admin.viewFormAmbientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId($id)
    {
        $value = Ambiente::where('ID_AMBIENTE', $id)->first();
        if(!$value){
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }
        //return view('search.ambiente');
        return response()->json(['message' => 'Ambiente encontrado', 'data' => $value], 200);
        
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCantidad($cantidad)
    {
        $numero_division = intdiv($cantidad, 10);
        return json_encode(Ambiente::where('CAPACIDAD', '>=', $numero_division*10-10)
            ->where('CAPACIDAD', '<=', $numero_division*10+10)->get(['NOMBRE']));
    }

    /**
     * Muestra a los ambientes por dia para las peticiones fetch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTodo($ambiente, $materia, $estado)
    {
        $value = Horario::with(
            'horario_relacion_dahm.dahm_relacion_ambiente'
            )->whereHas(
            'horario_relacion_dahm.dahm_relacion_ambiente', 
                function ($query) use ($ambiente, $estado){
                    if($ambiente != " "){
                        $query->where('ambiente.NOMBRE', 'LIKE', "%$ambiente%");
                    }
                    if($estado != " "){
                        $query->where('ambiente.ESTADO', $estado);
                    }
                }
            )->get();
        return json_encode($value);
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
