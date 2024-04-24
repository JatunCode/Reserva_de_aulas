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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ambientes = Ambiente::all();
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
            return redirect()->route('admin.viewFormAmbientes', ['ambientes' => $ambientes])->with('success', 'Ambiente creado exitosamente');
        }
        return view('admin.viewFormAmbientes', ['ambientes' => $ambientes]);
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
