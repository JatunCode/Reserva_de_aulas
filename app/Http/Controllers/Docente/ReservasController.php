<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $solicitudes = Solicitudes::paginate(10);

        // Envía los datos a la vista 'home'
        return view('docente.registro.reservas', ['solicitudes' => $solicitudes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

public function store(Request $request){
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string',
        'materia' => 'required|string',
        'grupo' => 'required|string',
        'cantidad_estudiantes' => 'required|integer',
        'motivo' => 'required|string',
        'modo' => 'required|string',
        'aula' => 'required|string',
        'fecha' => 'required|date',
        'horario' => 'required|string',
    ]);

    // Crear una nueva instancia de la solicitud
    $solicitud = new Solicitudes;
    $solicitud->nombre = $request->input('nombre');
    $solicitud->materia = $request->input('materia');
    $solicitud->grupo = $request->input('grupo');
    $solicitud->cantidad_estudiantes = $request->input('cantidad_estudiantes');
    $solicitud->motivo = $request->input('motivo');
    $solicitud->modo = $request->input('modo');
    $solicitud->razon = $request->input('razon');
    $solicitud->aula = $request->input('aula');
    $solicitud->horario = $request->input('horario');
    $solicitud->fecha = $request->input('fecha'); // Asegúrate de obtener correctamente el valor de 'fecha'
    $solicitud->estado = $request->input('estado');
    // Guardar la solicitud en la base de datos
    $solicitud->save();

    // Redirigir a la página de inicio del administrador
    return redirect()->route('docente.home')->with('success', 'Solicitud creada exitosamente');

}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $solicitud = Solicitudes::findOrFail($id);


        return response()->json(['solicitud' => $solicitud]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'nombre' => 'required|string',
            'materia' => 'required|string',
            'grupo' => 'required|string',
            'cantidad_estudiantes' => 'required|integer',
            'motivo' => 'required|string',
            'modo' => 'required|string',
            'razon' => 'nullable|string',
        ]);

        $solicitud->update($request->all());

        return response()->json(['message' => 'Solicitud actualizada exitosamente', 'solicitud' => $solicitud]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return response()->json(['message' => 'Solicitud eliminada exitosamente']);
    }
    public function cancelar($id)
    {
        // Encuentra la solicitud por su ID
        $solicitud = Solicitudes::findOrFail($id);

        // Asigna el estado "cancelado" a la solicitud
        $solicitud->estado = 'cancelado';

        // Guarda los cambios en la base de datos
        $solicitud->save();

        // Devuelve la solicitud cancelada como JSON
        return response()->json(['solicitud' => $solicitud, 'message' => 'Solicitud cancelada exitosamente']);
    }

    public function filtrar_modo()
    {
        // // Filtrar las solicitudes por modo "Urgente" y paginar el resultado
        $solicitudes = Solicitudes::where('modo', 'Urgente')->paginate(10);

        // Retornar la vista con las solicitudes filtradas y paginadas
        return view('docente.registro.reservas', ['solicitudes' => $solicitudes]);
        // return "Hola";
    }
    public function filtrar_llegada()
    {
        // // Filtrar las solicitudes por modo "Urgente" y paginar el resultado
        $solicitudes = Solicitudes::paginate(10);

        // Retornar la vista con las solicitudes filtradas y paginadas
        return view('docente.registro.reservas', ['solicitudes' => $solicitudes]);
        // return "Hola";
    }



}