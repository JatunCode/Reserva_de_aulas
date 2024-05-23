<?php

namespace App\Http\Controllers\Docente;
use DateTime;
use App\Http\Controllers\Controller;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Admin\Materia;
class CalendarioController extends Controller
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
        $solicitudesAll = Solicitudes::whereNotIn('ID_DOCENTE', ['354db6b6-be0f-4aca-a9ea-3c31e412c49d'])->get();

        //dump($relaciones);
        $pendientesCount = $solicitudes->where('estado', 'Cancelado')->count();
    $urgentesCount = $solicitudes->where('estado', 'Solicitando')->count();
    $reservadasCount = $solicitudes->where('estado', 'Reservado')->count();
        $anoActual = date('Y');
    
        // Convertir los datos en el formato adecuado para FullCalendar
        $eventos = [];
        foreach ($relaciones as $relacion) {
            $dow = $this->convertirDiaSemanaANumero($relacion->dahm_relacion_horario->DIA);
    
            // Obtener todas las fechas de "Lunes" en el año actual
            $fechasLunes = $this->obtenerFechasDiaSemanaEnAno($anoActual, $dow);

            // Agregar un evento para cada fecha de "Lunes"
            foreach ($fechasLunes as $fechaLunes) {
                // Agregar el evento al arreglo de eventos
                $eventos[] = [
                    'title' => $relacion->dahm_relacion_materia->NOMBRE. '-'.$relacion->dahm_relacion_ambiente->NOMBRE, // Nombre de la materia como título del evento
                    'start' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->INICIO, // Fecha y hora de inicio
                    'end' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->FIN, // Fecha y hora de fin
                    'dow' => [$dow], // Convertir el día de la semana a un array de un solo elemento
                    'aula' => $relacion->dahm_relacion_ambiente->NOMBRE,
                    'eventBackgroundColor'=>'#AFEEEE',
                    'textColor'=>'black',
                ];
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
    // Convertir las solicitudes en eventos y agregarlas al arreglo de eventos ALLLLLLLLLLLLLLLLLLLLLLLLLLLL
    foreach ($solicitudesAll as $solicitudAll) {
        
        $eventos[] = [
            'title' => $solicitudAll->motivo . '-'.$solicitudAll->aula . '-'.$solicitudAll->nombre, // Nombre de la solicitud como título del evento
            'start' => $solicitudAll->fecha . 'T' . $solicitudAll->hInicio, // Fecha y hora de inicio
            'end' => $solicitudAll->fecha . 'T' . $solicitudAll->hFin, // Fecha y hora de fin (misma que inicio)
            'aula' => $solicitudAll->aula,
            'modo' => $solicitudAll->modo,
            'materia' => $solicitudAll->materia,
            'estado' => $solicitudAll->estado,
            'eventBackgroundColor'=>'#080808',
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
   
}
