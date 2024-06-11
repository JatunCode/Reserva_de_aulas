<?php

namespace App\Http\Controllers\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Http\Controllers\scripts\GeneradorHorariosNoRegistrados;
use App\Models\Admin\Docente;
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
        //($usuario->cargo == 'admin') ? 
        Solicitud::all() 
        //: Solicitud::where()->get()
        ;
        $materias = Materia::all(['NOMBRE']);
        $solicitudes_estructuradas = [];
        
        foreach($solicitudes_fetch as $solicitud){
            $prio = (strpos($solicitud->PRIORIDAD, 'URGENTE')) ? 'URGENTE' : 'NORMAL';
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
        //return $solicitudes_estructuradas;
        return view('admin.listar.solicitudes', 
        [
            'solicitudes' => $solicitudes_estructuradas,
            'materias' => $materias]);
    }


    /**
     * Muestra los horarios de las solicitudes aceptadas
     * @param String $ambientes
     * @param String $fecha
     * @return Json retorna un json con la lista de los ambientes
     */
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
        //$solicitudes_fetch = (isset($usuario) && $usuario->cargo == 'admin') ? Solicitud::where('ID_DOCENTE', $usuario->ID_DOCENTE)->get() : Solicitud::all() ;
        $materias = Materia::all(['NOMBRE']);
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar
        $nombre_docente = (isset($usuario) && $usuario->cargo == 'docente') ? Docente::where('ID_DOCENTE', $usuario->ID_DOCENTE) : '';

        // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
        // Construir la consulta base
        // $solicitudes = Solicitud::where('LIKE','ID_DOCENTE_s', "%$idDocente%")
        //                             ->where('ESTADO', 'ACEPTADO')
        //                             ->get();
        $materiasAsociadas = [];
        foreach ($relaciones as $relacion) {
            // Obtener la colección de materias asociadas a través de la relación
            // Iterar sobre las materias para obtener sus nombres
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
        
        if(isset($usuario) && $usuario->cargo == 'docente'){
            return view('docente.solicitud.normal', [
                //'solicitudes' => $solicitudes, 
                'docente' => $nombre_docente,'materias' => $materiasAsociadas]);
        }else{
            return view('admin.viewFormSolicitud', [
                //'solicitudes' => $solicitudes, 
                'docente' => $nombre_docente, 'materias' => $materiasAsociadas]);
        }
    }


    /**
     * Muestra todas las solicitudes con un tipo por su materia, modo y estado
     * @param Materia el nombre de la materia a buscar
     * @param Modo el modo en el que se encuentra la solicitud
     * @param Estado el estado en que se encuentra la solicitud
     * @return \Illuminate\Http\JsonResponse
     */
    public function showSolicitud($id)
    {
        return Solicitud::where('ID_SOLICITUD', $id)->get();
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
        $buscador = new EncontrarTodo();
        $request->validate([
            'ID_SOLICITUD' => 'required|string',
            'ESTADO' => 'required|string'
        ]);

        $data = json_decode($request->getContent(), true);
        $solicitud = Solicitud::where('ID_SOLICITUD', $data->ID_SOLICUTD)
            ->update([
                'ESTADO'=> $data->ESTADO
            ]);

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
