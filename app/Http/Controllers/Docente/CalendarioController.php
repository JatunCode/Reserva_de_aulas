<?php

namespace App\Http\Controllers\Docente;
use DateTime;
use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\Automatizacion;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Docente\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $usuario = Auth::user()->cargo;
        $automatizacion = new Automatizacion();
        $automatizacion->updateAll();
        // ? TODOS LOS HORARIOS Obtener todas las relaciones_dahm filtradas por el ID del docente
        // $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
        //                             ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
        //                             ->get();
        
        $start_month = Date::now()->startOfMonth()->format('Y-m-d');
        $end_month = Date::now()->endOfMonth()->format('Y-m-d');
        $buscador = new EncontrarTodo();
        $solicitudes = Solicitud::where('ESTADO', 'PENDIENTE')->orWhere('ESTADO', 'ACEPTADO')->get(['ID_AMBIENTE','ID_DOCENTE_s','ID_MATERIA','FECHA_RE','MOTIVO', 'PRIORIDAD', 'ESTADO']);
        $solicitudesAll = Solicitud::all();

        //dump($relaciones);
        $pendientesCount = $solicitudesAll->where('ESTADO', 'PENDIENTE')->whereBetween('FECHA_RE', [$start_month, $end_month])->count();
        $reservadasCount = $solicitudesAll->where('ESTADO', 'ACEPTADO')->whereBetween('FECHA_RE', [$start_month, $end_month])->count();
        $urgentesCount = $solicitudesAll->where('PRIORIDAD', 'LIKE', '%URGENTE%')->where('FECHA_RE', '>=', $start_month)->where('FECHA_RE', '<=',$end_month)->count();
        $anoActual = date('Y');
    
        //? Convertir los horarios en el formato adecuado para FullCalendar
        // $eventos = [];
        // foreach ($relaciones as $relacion) {
        //     $dow = $this->convertirDiaSemanaANumero($relacion->dahm_relacion_horario->DIA);
    
        //     // Obtener todas las fechas de "Lunes" en el año actual
        //     $fechasLunes = $this->obtenerFechasDiaSemanaEnAno($anoActual, $dow);

        //     // Agregar un evento para cada fecha de "Lunes"
        //     foreach ($fechasLunes as $fechaLunes) {
        //         // Agregar el evento al arreglo de eventos
        //         $eventos[] = [
        //             'title' => $relacion->dahm_relacion_materia->NOMBRE. '-'.$relacion->dahm_relacion_ambiente->NOMBRE, // Nombre de la materia como título del evento
        //             'start' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->INICIO, // Fecha y hora de inicio
        //             'end' => $fechaLunes->format('Y-m-d') . 'T' . $relacion->dahm_relacion_horario->FIN, // Fecha y hora de fin
        //             'dow' => [$dow], // Convertir el día de la semana a un array de un solo elemento
        //             'aula' => $relacion->dahm_relacion_ambiente->NOMBRE,
        //             'eventBackgroundColor'=>'#AFEEEE',
        //             'textColor'=>'black',
        //         ];
        //     }
        // }
        // Convertir las solicitudes en eventos y agregarlas al arreglo de eventos
        foreach ($solicitudes as $solicitud) {
            if ($solicitud->ESTADO == 'PENDIENTE') {
                $backgroundColor = '#fff2cc'; // Color para estado Pendiente
            } elseif ($solicitud->ESTADO == 'ACEPTADO') {
                $backgroundColor = '#d9ead3'; // Color para estado Reservado
            } else {
                $backgroundColor = '#f2dede'; // Color por defecto para otros estados
            }
            $nombres = [];
            if(!is_object($solicitud->PRIORIDAD)){
                $fecha_hora = explode(' ',$solicitud->FECHA_RE);
                foreach ($buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s) as $nombre) {
                    $nombres [] = $nombre['Nombre_docente'];
                }
                $eventos[] = [
                    'title' => $solicitud->MOTIVO . '-'.$buscador->getNombreAmbiente($solicitud->ID_AMBIENTE), // Nombre de la solicitud como título del evento
                    'start' => $fecha_hora[0] . 'T' . $fecha_hora[1], // Fecha y hora de inicio
                    'end' => $fecha_hora[0] . 'T' . $solicitud->HORAFIN, // Fecha y hora de fin (misma que inicio)
                    'aula' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                    'modo' => (strpos($solicitud->PRIORIDAD,'URGENTE')) ? 'URGENTE' : 'NORMAL',
                    'materia' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                    'estado' => $solicitud->ESTADO,
                    'nombres' => implode(', ', $nombres),
                    'eventBackgroundColor'=>$backgroundColor,
                    'textColor'=>'white',
                    'motivo' => $solicitud->MOTIVO
                ];
            }
        }
        // ? no se que convierte :P Convertir las solicitudes en eventos y agregarlas al arreglo de eventos ALLLLLLLLLLLLLLLLLLLLLLLLLLLL
        // foreach ($solicitudesAll as $solicitudAll) {
            
        //     $eventos[] = [
        //         'title' => $solicitudAll->MOTIVO . '-'.$solicitudAll->aula . '-'.$solicitudAll->nombre, // Nombre de la solicitud como título del evento
        //         'start' => $solicitudAll->fecha . 'T' . $solicitudAll->hInicio, // Fecha y hora de inicio
        //         'end' => $solicitudAll->fecha . 'T' . $solicitudAll->hFin, // Fecha y hora de fin (misma que inicio)
        //         'aula' => $solicitudAll->aula,
        //         'modo' => $solicitudAll->modo,
        //         'materia' => $solicitudAll->materia,
        //         'estado' => $solicitudAll->estado,
        //         'eventBackgroundColor'=>'#080808',
        //         'textColor'=>'white',
        //     ];
        // }
        // Convertir los eventos a formato JSON para pasarlo a la vista
        $eventos_json = json_encode($eventos);
    
        return view('docente.home', compact('eventos_json', 'solicitudes','pendientesCount', 'urgentesCount', 'reservadasCount', 'usuario'));
        //return [$eventos, $urgentesCount, $pendientesCount, $reservadasCount];
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
        'Lunes' => 1,
        'Martes' => 2,
        'Miercoles' => 3,
        'Jueves' => 4,
        'Viernes' => 5,
        'Sabado' => 6,
        'Domingo' => 0,
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
