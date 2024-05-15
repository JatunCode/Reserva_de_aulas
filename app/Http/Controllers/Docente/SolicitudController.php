<?php

namespace App\Http\Controllers\Docente;
use DateTime;
use App\Http\Controllers\Controller;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;
use App\Models\Admin\Relacion_DAHM;
class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
      
    }
    
    

    private function convertirDiaSemanaANumero($nombreDia)
{
    // Array de nombres de días de la semana en español
    $diasSemana = [
        'lunes' => 1,
        'martes' => 2,
        'miercoles' => 3,
        'jueves' => 4,
        'viernes' => 5,
        'sabado' => 6,
        'domingo' => 0,
    ];

    // Convertir el nombre del día a minúsculas
    $nombreDia = strtolower($nombreDia);

    // Buscar el número de día de la semana en el array
    if (isset($diasSemana[$nombreDia])) {
        return $diasSemana[$nombreDia];
    } else {
        return null; // Devolver null si el nombre del día no es válido
    }
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
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d';
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
             $solicitud->ID_Docente = $idDocente;
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
     public function docente_datos(Request $request)
     {
        $solicitudess = [
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
    
    
       
         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar
 
         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                     ->get();
         // Construir la consulta base
         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
         ->where('estado', 'Reservado')
         ->get();
         $materiasAsociadas = [];
         foreach ($relaciones as $relacion) {
     // Obtener la colección de materias asociadas a través de la relación
     $materias = $relacion->dahm_relacion_materia;
     // Iterar sobre las materias para obtener sus nombres
     foreach ($materias as $materia) {
         // Obtener el nombre de la materia y agregarlo al array si no existe aún
         $nombreMateria = $materia->NOMBRE;
         if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
             $materiasAsociadas[] = $nombreMateria;
         }
     }
    }
        
        return view('docente.solicitud.normal', ['solicitudes' => $solicitudess,'materias' => $materiasAsociadas]);
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
