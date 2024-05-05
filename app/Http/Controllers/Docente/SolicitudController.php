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
        // Obtener todas las relaciones_dahm filtradas por el ID del docente
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
    
        $solicitudes = Solicitudes::where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')->get();
        //dump($relaciones);
        $pendientesCount = $solicitudes->where('estado', 'Cancelado')->count();
    $urgentesCount = $solicitudes->where('estado', 'Solicitando')->count();
    $reservadasCount = $solicitudes->where('estado', 'Reservado')->count();
        $anoActual = date('Y');
    
        // Convertir los datos en el formato adecuado para FullCalendar
        $eventos = [];
        foreach ($relaciones as $relacion) {
            foreach ($relacion->dahm_relacion_materia as $materia) {
                // Convertir el nombre del día a un número de día de la semana
                $dow = $this->convertirDiaSemanaANumero($relacion->dahm_relacion_horario->DIA);
    
                // Obtener todas las fechas de "Lunes" en el año actual
                $fechasLunes = $this->obtenerFechasDiaSemanaEnAno($anoActual, $dow);
    
                // Agregar un evento para cada fecha de "Lunes"
                foreach ($fechasLunes as $fechaLunes) {
                    // Agregar el evento al arreglo de eventos
                    $eventos[] = [
                        'title' => $materia->NOMBRE. '-'.$relacion->dahm_relacion_ambiente->NOMBRE, // Nombre de la materia como título del evento
                        'start' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->INICIO, // Fecha y hora de inicio
                        'end' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->FIN, // Fecha y hora de fin
                        'dow' => [$dow], // Convertir el día de la semana a un array de un solo elemento
                        'aula' => $relacion->dahm_relacion_ambiente->NOMBRE,
                        'eventBackgroundColor'=>'#AFEEEE',
                        'textColor'=>'black',
                    ];
                }
            }
        }
    // Convertir las solicitudes en eventos y agregarlas al arreglo de eventos
    foreach ($solicitudes as $solicitud) {
        if ($solicitud->estado == 'Solicitando') {
            $backgroundColor = '#CCCC00'; // Color para estado Pendiente
        } elseif ($solicitud->estado == 'Reservado') {
            $backgroundColor = '#006600'; // Color para estado Reservado
        } 
        else {
            $backgroundColor = '#990000'; // Color por defecto para otros estados
        }
        $eventos[] = [
            'title' => $solicitud->motivo . '-'.$solicitud->aula, // Nombre de la solicitud como título del evento
            'start' => $solicitud->fecha . 'T' . $solicitud->hInicio, // Fecha y hora de inicio
            'end' => $solicitud->fecha . 'T' . $solicitud->hFin, // Fecha y hora de fin (misma que inicio)
            'aula' => $solicitud->aula,
            'modo' => $solicitud->modo,
            'materia' => $solicitud->materia,
            'estado' => $solicitud->estado,
            'eventBackgroundColor'=>$backgroundColor,
            'textColor'=>'white',
        ];
    }
        // Convertir los eventos a formato JSON para pasarlo a la vista
        $eventos_json = json_encode($eventos);
    
        return view('docente.home', compact('eventos_json', 'solicitudes','pendientesCount', 'urgentesCount', 'reservadasCount'));
    }
    
    // Función para obtener todas las fechas de un día de la semana en un año específico
    private function obtenerFechasDiaSemanaEnAno($ano, $dow) {
        $fechas = [];
        $fecha = new DateTime();
        $fecha->setISODate($ano, 1, $dow); // Establecer la fecha en la primera ocurrencia del día de la semana en el año dado
        while ($fecha->format('Y') == $ano) {
            $fechas[] = clone $fecha;
            $fecha->modify('+1 week'); // Avanzar una semana
        }
        return $fechas;
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
