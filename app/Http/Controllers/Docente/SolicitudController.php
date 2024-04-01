<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $solicitudes = Solicitudes::all();
        // return response()->json(['solicitudes' => $solicitudes]);
        // return 'Hola index';
        $solicitudes = [
            (object) ['id' => 1, 'aula' => '691A', 'horario' => '15:45 PM - 16:15 PM', 'fecha' => '2024-02-16'],
            (object) ['id' => 2, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-02-16'],
            // Agrega más datos de solicitud aquí si es necesario
        ];

        // Envía los datos a la vista 'home'
        return view('docente.home', ['solicitudes' => $solicitudes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function store(Request $request)
     {
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

         try {
             // Crear una nueva instancia de la solicitud
             $solicitud = new Solicitudes;
             $solicitud->nombre = $request->input('nombre');
             $solicitud->materia = $request->input('materia');
             $solicitud->grupo = $request->input('grupo');
             $solicitud->cantidad_estudiantes = $request->input('cantidad_estudiantes');
             $solicitud->motivo = $request->input('motivo');
             $modo = $request->input('modo') == 1 ? 'Normal' : 'Urgente';
             $solicitud->modo = $modo;
             $solicitud->razon = $request->input('razon');
             $solicitud->aula = $request->input('aula');
             $solicitud->horario = $request->input('horario');
             $solicitud->fecha = $request->input('fecha'); // Asegúrate de obtener correctamente el valor de 'fecha'

             // Guardar la solicitud en la base de datos
             $solicitud->save();

             // Redirigir con un mensaje de éxito
             return redirect()->route('docente.home')->with('success', 'Solicitud creada exitosamente');
         } catch (\Exception $e) {
             // Capturar cualquier excepción que pueda ocurrir durante el proceso de guardado
             // Puedes registrar el error o devolver una respuesta de error personalizada
             // Por ejemplo:
             return redirect()->back()->withInput()->withErrors(['error' => 'Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
         }
     }


    public function storee(Request $request)
    {

        print_r($_POST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Solicitud $solicitud)
    {
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
}
