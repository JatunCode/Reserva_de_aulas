<?php

namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Http\Controllers\scripts\GeneradorHorariosNoRegistrados;
use App\Models\Admin\Materia;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Docente\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Uuid;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$usuario = Auth::user();
        $buscador = new EncontrarTodo();
        $solicitudes_fetch = 
        //(isset($usuario) && $usuario->cargo == 'docente') ? Solicitud::where('ID_DOCENTE', $usuario->ID_DOCENTE)->get() : 
        Solicitud::all();
        $materias = Materia::all(['NOMBRE']);
        $solicitudes_estructuradas = [];
        
        foreach($solicitudes_fetch as $solicitud){
            $prio = (strpos($solicitud->PRIORIDAD, 'URGENTE')) ? json_decode($solicitud->PRIORIDAD) : 'NORMAL';
            if(isset($solicitud)){
                $solicitudes_estructuradas[] = [
                    'ID' => $solicitud->ID_SOLICITUD,
                    'NOMBRES_DOCENTES' => $buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s),
                    'MATERIA' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                    'AMBIENTE' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                    'GRUPOS' => $solicitud->GRUPOS,
                    'CANTIDAD' => $solicitud->CANTIDAD_EST,
                    'FECHA_RESERVA' => $solicitud->FECHA_RE,
                    'FECHA_SOLICITUD' => $solicitud->FECHAHORA_SOLI,
                    'HORARIO' => $solicitud->HORAINI.' - '.$solicitud->HORAFIN,
                    'MOTIVO' => $solicitud->MOTIVO,
                    'MODO' => $prio,
                    'ESTADO' => $solicitud->ESTADO
                ];
            }
        }
        
        // return [
        //     'solicitudes' => $solicitudes_estructuradas, 
        //     // 'nombre' => 
        //     //     ($usuario->cargo == 'admin') ? 
        //     //         $buscador->getNombreDocenteporId($usuario->ID_DOCENTE) : '',
        //     'materias' => $materias];

        return view('admin.listar.solicitudes', 
        [
            'solicitudes' => $solicitudes_estructuradas, 
            // 'nombre' => 
            //     ($usuario->cargo == 'docente') ? 
            //         $buscador->getNombreDocenteporId($usuario->ID_DOCENTE) : '',
            'materias' => $materias]);
    }

    public function solicitudes_libres($ambiente, $fecha){
        $solicitudes = [];
        $fecha_seg = strtotime($fecha);
        $reservas = Solicitud::with(
                        'solicitud_relacion_ambiente'
                        )->whereHas(
                            'solicitud_relacion_ambiente', 
                            function ($query) use ($ambiente) {
                                $query->where('ambiente.NOMBRE', $ambiente);
                            }
                        )->where(
                            'ESTADO', 'ACEPTADO'
                        )->where(
                            'FECHA_RE','LIKE', "%$fecha%"
                        )->orderBy('FECHA_RE')->get();

        foreach($reservas as $solicitud){
            $solicitudes[] = [
                'DIA' => date('l', $fecha_seg),
                'INICIO' => $solicitud->HORAINI,
                'FIN' => $solicitud->HORAFIN
            ];
        }

        $object = [
            'dia' => date('l', $fecha_seg),
            'arreglo' => $solicitudes
        ];
        
        $generador = new GeneradorHorariosNoRegistrados();
        $soli_libres = [];

        foreach($generador->horarios_no_reg("solicitudes", $object, $ambiente) as $solicitud){
            $soli_libres[] = [
                'DIA' => $solicitud['DIA'],
                'HORARIO' => $solicitud['HORA_INI']." - ".$solicitud['HORA_FIN'],
                'AMBIENTE' => $solicitud['AMBIENTE']
            ];
        }

        return json_encode($soli_libres);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function store(Request $request)
     {
        $buscardor = new EncontrarTodo();
        $uuid = Uuid::uuid4();
        try {
            $request->validate([
                'NOMBRES' => ['required', 'json',  
                    function($attribute, $value, $fail){
                        $decoder = json_decode($value);
                        if(!is_array($decoder) || count($decoder) < 1 || count($decoder) > 4){
                            $fail($attribute.' debe contener al menos uno a cuatro docentes.');
                        }
                    }],
                'CANTIDAD' => 'required|integer',
                'FECHA_RESERVA' => 'required|date_format:Y-m-d H:i',
                'HORA_INICIO' => 'required|date_format:H:i',
                'HORA_FIN' => 'required|date_format:H:i',
                'PRIORIDAD' => ['required', 'json',
                        function($attribute, $value, $fail){
                            $decoder = json_decode($value, true);
                            if (!is_array($decoder) || count($decoder) != 1) {
                                $fail($attribute.' debe ser un objeto JSON con un solo par clave-valor.');
                            }
                        }],
                'MOTIVO' => 'required|string',
                'MATERIA' => 'required|string',
                'AMBIENTE' => 'required|string'
            ]);

            $idsygruposDocente = $buscardor->getGruposyIdsDocentes(json_decode($request->NOMBRES));
            Solicitud::create([
                'ID_SOLICITUD' => $uuid->toString(),
                'ID_DOCENTE_s' => $idsygruposDocente[0],
                'CANTIDAD_EST' => $request->CANTIDAD,
                'FECHA_RE' => $request->FECHA_RESERVA,
                'HORAINI' => $request->HORA_INICIO,
                'HORAFIN' => $request->HORA_FIN,
                'FECHAHORA_SOLI' => Date::now(),
                'MOTIVO' => $request->MOTIVO,
                'PRIORIDAD' => json_encode($request->PRIORIDAD),
                'ID_MATERIA' => $buscardor->getIdMateria($request->MATERIA),
                'GRUPOS' => $idsygruposDocente[1],
                'ID_AMBIENTE' => $buscardor->getIdAmbiente($request->AMBIENTE),
                'ESTADO' => 'PENDIENTE'
            ]);
            return response()->json(["message" => "Solicitud creada exitosamente"], 200);
        } catch (\Exception $e) {
            //return redirect()->back()->withInput()->withErrors(['error' => 'Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
            return response()->json(["message" => "Hubo un error en el servidor: $e"], 500);
        }
     }
     
    //Se debe realizar dos uno en el que se sepa que es admin y otro para docente
    /**
     * @param Request debe ser el id o el nombre del docente
     * @return response mostrar los datos del docente en el registro
     */
    public function docente_datos(Request $request)
    { 
        $usuario = Auth::user();
        $buscador = new EncontrarTodo();
        $solicitudes_fetch = ($usuario->cargo == 'admin') ? Solicitud::all() : Solicitud::where('ID_DOCENTE', $usuario->ID_DOCENTE)->get();
        $materias = Materia::all(['NOMBRE']);
        $solicitudes_estructuradas = [];
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
            // Iterar sobre las materias para obtener sus nombres
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
        
        return view('docente.solicitud.normal', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }

    /**
     * Muestra todas las solicitudes en estado pendiente para la atencuin de una solicitud
     * @param Materia el nombre de la materia a buscar
     * @param Modo el modo en el que se encuentra la solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAtencion($docente, $materia, $modo)
    {
        $buscador =  new EncontrarTodo();
        $modo = strtoupper($modo);
        $solicitudes = Solicitud::with(
                        'solicitud_relacion_ambiente',
                        'solicitud_relacion_materia',
                        )->whereHas(
                            'solicitud_relacion_ambiente',
                            function ($query) use ($docente, $materia, $modo, $buscador){
                                if($materia != " "){
                                    $query->where('ID_MATERIA', $buscador->getIdMateria($materia));
                                }
                                if($modo != " "){
                                    $query->where('PRIORIDAD', 'LIKE', "%$modo%");
                                }
                                if($docente != " "){
                                    $query->where(
                                        'ID_DOCENTE_s', 'LIKE', "%{$buscador->getIdDocenteporNombre($docente)}%"
                                    );
                                }
                            }
                        )->where('ESTADO', 'CANCELADO')->orderBy('FECHA_RE')->get();
        $solicitudes_estructuradas = [];
        $nombre_docentes = [];
        foreach($solicitudes as $solicitud){
            $nombre_docentes = $buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s);
            $data_reservar = date_create($solicitud->FECHA_RE.str_split(" ")[0]);
            $data_solicitar = date_create($solicitud->FECHAHORA_SOLI.str_split(" ")[0]);
            
            $solicitudes_estructuradas[] = [
                'NOMBRE_DOCENTES' => $nombre_docentes,
                'CANTIDAD' => $solicitud->CANTIDAD_EST,
                'FECHA_RESERVA' => date_format($data_reservar, 'd/m/Y'),
                'HORARIO' => $solicitud->HORAINI." - ".$solicitud->HORAFIN,
                'FECHA_HORASOLI' => date_format($data_solicitar, 'd/m/Y'),
                'MOTIVO' => $solicitud->MOTIVO,
                'MODO' => json_decode($solicitud->PRIORIDAD, true),
                'MATERIA' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                'GRUPOS' => json_decode($solicitud->GRUPOS, true),
                'AMBIENTE' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                'ESTADO' => $solicitud->ESTADO
            ];
        }
        return $solicitudes_estructuradas;
    }

    /**
     * Muestra todas las solicitudes con un tipo por su materia, modo y estado
     * @param Materia el nombre de la materia a buscar
     * @param Modo el modo en el que se encuentra la solicitud
     * @param Estado el estado en que se encuentra la solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function showTodo($materia, $modo, $estado)
    {
        $buscador =  new EncontrarTodo();
        $modo = strtoupper($modo);
        $solicitudes = Solicitud::with(
                        'solicitud_relacion_ambiente'
                        )->whereHas(
                            'solicitud_relacion_ambiente',
                            function ($query) use ($materia, $modo, $estado, $buscador){
                                $query->where('ID_MATERIA', $buscador->getIdMateria($materia));
                                $query->where('PRIORIDAD', 'LIKE', "%$modo%");
                                $query->where('ESTADO', $estado);
                            }
                        )->orderBy('FECHA_RE')->get();
        return $solicitudes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'ID_SOLICITUD' => 'required|string',
            'ESTADO' => 'required|string'
        ]);

        $solicitud = Solicitud::where('ID_SOLICITUD', $request->ID_SOLICUTD)->update(['ESTADO', $request->ESTADO]);

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
