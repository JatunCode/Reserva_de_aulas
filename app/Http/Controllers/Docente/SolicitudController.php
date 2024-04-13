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

    }
    public function fecha()
{

    // Array de objetos de ejemplo
    $solicitudes = [
        (object) ['id' => 1, 'aula' => '691A', 'horario' => '15:45 PM - 16:15 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 2, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 3, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 4, 'aula' => '691C', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 5, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 6, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 7, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 8, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 9, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 10, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 11, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 12, 'aula' => '91B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 13, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 14, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 15, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 16, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
    ];



    // Paginar las solicitudes filtradas (si es necesario)
     // Ejemplo de paginación con array_slice

    // Retornar la vista con las solicitudes filtradas y paginadas
    return view('docente.solicitud.normal', ['solicitudes' => $solicitudes]);
}
public function normal()
{

    // Array de objetos de ejemplo
    $solicitudes = [
        (object) ['id' => 1, 'aula' => '691A', 'horario' => '15:45 PM - 16:15 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 2, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 3, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 4, 'aula' => '691C', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 5, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 6, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 7, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 8, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 9, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 10, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 11, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 12, 'aula' => '91B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 13, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 14, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 15, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 16, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
    ];



    // Paginar las solicitudes filtradas (si es necesario)
     // Ejemplo de paginación con array_slice

    // Retornar la vista con las solicitudes filtradas y paginadas
    return view('docente.solicitud.normal', ['solicitudes' => $solicitudes]);
}
public function urgente()
{

    // Array de objetos de ejemplo
    $solicitudes = [
        (object) ['id' => 1, 'aula' => '691A', 'horario' => '15:45 PM - 16:15 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 2, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-02-16'],
        (object) ['id' => 3, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 4, 'aula' => '691C', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-03-16'],
        (object) ['id' => 5, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 6, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 7, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 8, 'aula' => '69B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 9, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-04-20'],
        (object) ['id' => 10, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 11, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 12, 'aula' => '91B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 13, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-17'],
        (object) ['id' => 14, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 15, 'aula' => '691B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
        (object) ['id' => 16, 'aula' => '61B', 'horario' => '16:30 PM - 17:00 PM', 'fecha' => '2024-05-20'],
    ];



    // Paginar las solicitudes filtradas (si es necesario)
     // Ejemplo de paginación con array_slice

    // Retornar la vista con las solicitudes filtradas y paginadas
    return view('docente.solicitud.urgente', ['solicitudes' => $solicitudes]);
}

    // public function urgente()
    // {

    //     $solicitudes = Solicitudes::paginate(10);

    //     // Envía los datos a la vista 'home'
    //     return view('docente.solicitud.urgente', ['solicitudes' => $solicitudes]);
    // }
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
             'nombre1' => 'nullable|string',
             'nombre2' => 'nullable|string',
             'nombre3' => 'nullable|string',
             'nombre4' => 'nullable|string',
             'nombre5' => 'nullable|string',
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
             $solicitud->nombre1 = $request->input('nombre1');
             $solicitud->nombre2 = $request->input('nombre2');
             $solicitud->nombre3 = $request->input('nombre3');
             $solicitud->nombre4 = $request->input('nombre4');
             $solicitud->nombre5 = $request->input('nombre5');
             $solicitud->materia = $request->input('materia');
             $solicitud->grupo = $request->input('grupo');
             $solicitud->cantidad_estudiantes = $request->input('cantidad_estudiantes');
             $solicitud->motivo = $request->input('motivo');
             $solicitud->modo = $request->input('modo');
             $solicitud->razon = $request->input('razon');
             $solicitud->aula = $request->input('aula');
             $solicitud->horario = $request->input('horario');
             $solicitud->fecha = $request->input('fecha'); // Asegúrate de obtener correctamente el valor de 'fecha'
             $solicitud->estado = $request->input('fecha');
             $solicitud->estado = 'Solicitando';
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