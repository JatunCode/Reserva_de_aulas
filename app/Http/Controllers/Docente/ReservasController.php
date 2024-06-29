<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Admin\Materia;
use App\Models\Docente\Solicitudes;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Docente\Razones;
use App\Models\Docente\Reserva;
use App\Models\Docente\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Uuid;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $usuario = Auth::user();
        $buscador =  new EncontrarTodo();
        $solicitudes = collect();
        if($usuario->cargo == 'admin'){
            $solicitudes_urgentes = Solicitud::with(
                'solicitud_relacion_ambiente',
                'solicitud_relacion_materia',
            )->where('ESTADO', 'PENDIENTE')->where('PRIORIDAD','LIKE' ,'%URGENTE%')->orderBy('FECHAHORA_SOLI')->get();
            $solicitudes_normales = Solicitud::with(
                'solicitud_relacion_ambiente',
                'solicitud_relacion_materia',
            )->where('ESTADO', 'PENDIENTE')->where('PRIORIDAD', 'LIKE', '%NORMAL%')->orderBy('FECHAHORA_SOLI')->get();
            $solicitudes = $solicitudes->merge($solicitudes_urgentes)->merge($solicitudes_normales);
        }else{
            $solicitudes = Solicitud::with(
                'solicitud_relacion_ambiente',
                'solicitud_relacion_materia',
            )->where('ESTADO', 'PENDIENTE')->where('ID_DOCENTE_s', 'LIKE', "%$usuario->ID_DOCENTE%")
            ->orderBy('FECHAHORA_SOLI')->get();

            $materias = Materia::whereHas('materia_relacion_dm', 
                    function($query)use($usuario){
                        $query->where('ID_DOCENTE', $usuario->ID_DOCENTE);
                    })->get(['NOMBRE']);
        }
        $solicitudes_estructuradas = [];
        $nombre_docentes = [];
        foreach($solicitudes as $solicitud){
            $prio = (strpos($solicitud->PRIORIDAD, 'URGENTE')) ? 'URGENTE' : 'NORMAL';
            $nombre_docentes = $buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s);
            
            $solicitudes_estructuradas[] = [
                'ID' => $solicitud->ID_SOLICITUD,
                'NOMBRE_DOCENTES' => $nombre_docentes,
                'CANTIDAD' => $solicitud->CANTIDAD_EST,
                'FECHA_HORASOLI' => $solicitud->FECHAHORA_SOLI,
                'FECHA_RESERVA' => $solicitud->FECHA_RE,
                'HORARIO' => $solicitud->HORAINI." - ".$solicitud->HORAFIN,
                'MOTIVO' => $solicitud->MOTIVO,
                'MODO' => $prio,
                'MATERIA' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                'GRUPOS' => $solicitud->GRUPOS,
                'AMBIENTE' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                'ESTADO' => $solicitud->ESTADO
            ];
        }
        $razones = Razones::all();
        if($usuario->cargo == 'admin'){
            return view('admin.layouts.reservas', ['solis_no_reser' => $solicitudes_estructuradas, 'razones' => $razones]); 
        }else{
            return view('docente.listar.cancelar', ['solis_no_reser' => $solicitudes_estructuradas, 'materias' => $materias]);
        }
    }


    public function indexCancelar()
    {
        $usuario = Auth::user();
        $fecha_actual = Date::now();
        $buscador = new EncontrarTodo();
        $materias = Materia::whereHas('materia_relacion_dm', 
                    function($query)use($usuario){
                        $query->where('ID_DOCENTE', $usuario->ID_DOCENTE);
                    })->get(['NOMBRE']);
        $solicitudes = ($usuario->cargo == 'admin') ? Solicitud::with(
            'solicitud_relacion_ambiente',
            'solicitud_relacion_materia',
            )->where('ESTADO', 'ACEPTADO')->orderBy('FECHAHORA_SOLI')
            ->where('FECHA_RE', '>=', $fecha_actual)->get() : 
            Solicitud::with(
                'solicitud_relacion_ambiente',
                'solicitud_relacion_materia',
                )
            ->where('ESTADO', 'ACEPTADO')
            ->where('ID_DOCENTE_s', 'LIKE', "%$usuario->ID_DOCENTE%")
            ->where('FECHA_RE', '>=', $fecha_actual)->orderBy('FECHAHORA_SOLI')->get();
        $solicitudes_estructuradas = [];
        $nombre_docentes = [];
        foreach($solicitudes as $solicitud){
            $prio = (strpos($solicitud->PRIORIDAD, 'URGENTE')) ? 'URGENTE' : 'NORMAL';
            $nombre_docentes = $buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s);
            $data_reservar = date_create($solicitud->FECHA_RE.str_split(" ")[0]);
            $data_solicitar = date_create($solicitud->FECHAHORA_SOLI.str_split(" ")[0]);
            
            $solicitudes_estructuradas[] = [
                'ID' => $solicitud->ID_SOLICITUD,
                'NOMBRE_DOCENTES' => $nombre_docentes,
                'CANTIDAD' => $solicitud->CANTIDAD_EST,
                'FECHA_RESERVA' => date_format($data_reservar, 'd/m/Y'),
                'HORARIO' => $solicitud->HORAINI." - ".$solicitud->HORAFIN,
                'FECHA_HORASOLI' => date_format($data_solicitar, 'd/m/Y'),
                'MOTIVO' => $solicitud->MOTIVO,
                'MODO' => $prio,
                'DESC' => $solicitud->PRIORIDAD,
                'MATERIA' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                'GRUPOS' => $solicitud->GRUPOS,
                'AMBIENTE' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                'ESTADO' => $solicitud->ESTADO
            ];
        }
        $razones = Razones::all();
        if($usuario->cargo == 'admin'){
            return view('admin.layouts.reservasCancelar', ['solis_no_reser' => $solicitudes_estructuradas, 'razones' => $razones]);
        }else{
            return view('docente.reserva', ['solis_no_reser' => $solicitudes_estructuradas, 'materias' => $materias]);
        }
    }
   
    // public function datos(Request $request)
    // {
    //     $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

    //     // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
    //     $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
    //                                 ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
    //                                 ->get();
    //     // Construir la consulta base
    //     $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
    //     $materiasAsociadas = [];
    //     foreach ($relaciones as $relacion) {
    //     // Obtener la colección de materias asociadas a través de la relación
    //         // Iterar sobre las materias para obtener sus nombres
    //         $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
    //         if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
    //             $materiasAsociadas[] = $nombreMateria;
    //         }
    //     }
    //     // Devolver las solicitudes como respuesta en formato JSON
    //     return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    // }


    // public function cancelar_solicitud(Request $request)
    // {
    //     $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

    //     // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
    //     $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
    //                                 ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
    //                                 ->get();
    //     // Construir la consulta base
    //     $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
    //     $materiasAsociadas = [];
    //     foreach ($relaciones as $relacion) {
    //         // Iterar sobre las materias para obtener sus nombres
    //         foreach ($relaciones as $relacion) {
    //             // Obtener la colección de materias asociadas a través de la relación
    //             $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
    //             if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
    //                 $materiasAsociadas[] = $nombreMateria;
    //             }
    //         }
    //     }

    //     // Devolver las solicitudes como respuesta en formato JSON
    //     return view('docente.listar.cancelar', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request){
        // Validar los datos del formulario
        $usuario = Auth::user();
        $buscador = new EncontrarTodo();
        $id = Uuid::uuid4();

        $razones_no_reg = [];
        $solicitud = Solicitud::where('ID_SOLICITUD', $request->ID_SOLICITUD);
        try{
            if($usuario->cargo == 'admin'){
                foreach($request['ACTUALIZACIONES']['LISTA_NO_REG'] as $razon){
                    $razon_id = Razones::create(['razon' => $razon])->id_razon;
                    $razones_no_reg [] = $razon_id;
                }
            }
            $arreglo = ($request->ESTADO != 'ACEPTADO') ? array_merge($usuario->cargo == 'admin' ? $request['ACTUALIZACIONES']['LISTA_REG'] : [], $razones_no_reg):'Ninguno';
            Reserva::create([
                'ID_RESERVA' => $id,
                'ID_SOLICITUD' => $request->ID_SOLICITUD,
                'RAZONES' => json_encode($arreglo),
                'FECHAHORA_RESER' => date('Y-m-d')
            ]);
            $solicitud->update(['ESTADO'=> $request->ESTADO, 'ID_AMBIENTE' => $buscador->getIdAmbiente($request->AMBIENTE)]);
            return response()->json(['objeto_soli'=>$solicitud, 'message'=>'Reserva guardad con exito'], 200);
        }catch(\Exception $error){
            return response()->json(['objeto_soli'=>$solicitud,'message'=>'Error del servidor.'.$error], 500);
        }
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
    public function update(Request $request)
    {
        $razones_no_reg = [];
        try {
            $request->validate([
                'ID_SOLICITUD' => 'required',
                'ESTADO' => 'required'
            ]);

            $id_solicitud = $request->ID_SOLICITUD;

            foreach($request['ACTUALIZACIONES']['LISTA_NO_REG'] as $razon){
                $razon_id = Razones::create(['razon' => $razon])->id_razon;
                $razones_no_reg [] = $razon_id;
            }
            $arreglo = array_merge($request->ACTUALIZACIONES['LISTA_REG'], $razones_no_reg);
            $reserva = Reserva::where('ID_SOLICITUD', $id_solicitud)->update(['RAZONES' => json_encode($arreglo)]);
            $solicitud = Solicitud::where('ID_SOLICITUD', $id_solicitud)->update(['ESTADO' => $request->ESTADO]);
    
            return response()->json(['message' => 'Solicitud actualizada exitosamente', 'solicitud' => $solicitud, 'reserva' => $reserva], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Falta un arreglo'.$th, 'solicitud' => $solicitud, 'reserva' => $reserva], 500);
        }
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

    public function showReservas($id)
    {

        $solicitud = Solicitudes::leftJoin('razones', 'solicitudes.id_razon', '=', 'razones.id_razones')
        ->where('solicitudes.id', $id)
        ->select('solicitudes.*', 'razones.razon')
        ->firstOrFail();


        return response()->json(['solicitud' => $solicitud]);
    }


}