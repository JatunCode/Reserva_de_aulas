<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RazonesController;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Docente\Solicitudes;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Docente\Razones;
use App\Models\Docente\Reserva;
use App\Models\Docente\Solicitud;
use Illuminate\Http\Request;
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
        $buscador =  new EncontrarTodo();
        $solicitudes = Solicitud::with(
                        'solicitud_relacion_ambiente',
                        'solicitud_relacion_materia',
                        )->where('ESTADO', 'PENDIENTE')->orderBy('FECHA_RE')->get();
        $solicitudes_estructuradas = [];
        $nombre_docentes = [];
        foreach($solicitudes as $solicitud){
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
                'MODO' => (strpos($solicitud->PRIORIDAD, 'URGENTE')) ? 'Urgente' : 'Normal',
                'DESC' => $solicitud->PRIORIDAD,
                'MATERIA' => $buscador->getNombreMateria($solicitud->ID_MATERIA),
                'GRUPOS' => $solicitud->GRUPOS,
                'AMBIENTE' => $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE),
                'ESTADO' => $solicitud->ESTADO
            ];
        }
        $razones = Razones::all();
        return view('admin.layouts.reservas', ['solis_no_reser' => $solicitudes_estructuradas, 'razones' => $razones]);
    }
   
//     public function datos(Request $request)
//     {
//         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

//         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
//         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
//                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
//                                     ->get();
//         // Construir la consulta base
//         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
//         $materiasAsociadas = [];
//         foreach ($relaciones as $relacion) {
//         // Obtener la colección de materias asociadas a través de la relación
//             // Iterar sobre las materias para obtener sus nombres
//             $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
//             if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
//                 $materiasAsociadas[] = $nombreMateria;
//             }
//         }
        

        

//         // Devolver las solicitudes como respuesta en formato JSON
//         return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
//     }
//     public function datos_cancelar(Request $request)
//     {
//         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

//         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
//         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
//                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
//                                     ->get();
//         // Construir la consulta base
//         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
//         ->where('estado', 'cancelado')
//         ->get();
//         $materiasAsociadas = [];
//         foreach ($relaciones as $relacion) {
//             // Obtener la colección de materias asociadas a través de la relación
//             // Iterar sobre las materias para obtener sus nombres
//             $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
//             if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
//                 $materiasAsociadas[] = $nombreMateria;
//             }
//         }
//            // Devolver las solicitudes como respuesta en formato JSON
//         return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
//     }


//     public function datos_solicitando(Request $request)
//     {
//         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

//         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
//         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
//                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
//                                     ->get();
//         // Construir la consulta base
//         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
//         ->where('estado', 'Solicitando')
//         ->get();
//         $materiasAsociadas = [];
//         foreach ($relaciones as $relacion) {
//             // Obtener la colección de materias asociadas a través de la relación
//             $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
//             if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
//                 $materiasAsociadas[] = $nombreMateria;
//             }
//         }
//            // Devolver las solicitudes como respuesta en formato JSON
//         return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
//     }
//     public function datos_reservado(Request $request)
//     {
//         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

//         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
//         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
//                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
//                                     ->get();
//         // Construir la consulta base
//         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
//                 ->where('estado', 'Reservado')
//                 ->get();
//         $materiasAsociadas = [];
//         foreach ($relaciones as $relacion) {
//             // Obtener la colección de materias asociadas a través de la relación
//             $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
//             if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
//                 $materiasAsociadas[] = $nombreMateria;
//             }
//         }
//            // Devolver las solicitudes como respuesta en formato JSON
//         return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
//     }
//     public function cancelar_solicitud(Request $request)
//     {
//         $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

//         // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
//         $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
//                                     ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
//                                     ->get();
//         // Construir la consulta base
//         $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
//         $materiasAsociadas = [];
//         foreach ($relaciones as $relacion) {
//             // Iterar sobre las materias para obtener sus nombres
//             foreach ($relaciones as $relacion) {
//                 // Obtener la colección de materias asociadas a través de la relación
//                 $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
//                 if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
//                     $materiasAsociadas[] = $nombreMateria;
//                 }
//             }
//         }
                

        

//         // Devolver las solicitudes como respuesta en formato JSON
//         return view('docente.listar.cancelar', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
//     }
//     public function datos_filtro(Request $request)
//     {
 
//         $filtroModo = $request->input('modo');
//         $filtroEstado = $request->input('estado');
//         $filtroMateria = $request->input('materia');
//         // Construir la consulta base
//         $query = Solicitudes::where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d');
        
//         // Aplicar filtros si están presentes
   
//         if ($filtroMateria!==null) {
//             $query->where('materia', $filtroMateria);
//         }
           
        
//         if ($filtroModo!== "Todos") {
//             $query->where('modo', $filtroModo);
//         }
//         // Aplicar el filtro de estado solo si es diferente de "Todos"
//         if ($filtroEstado !== "Todos") {
            
//             $query->where('estado', $filtroEstado);
//         }
        
//         // Obtener las solicitudes filtradas
//         $solicitudes = $query->get();
        
//         // Devolver las solicitudes filtradas como respuesta en formato JSON
//         return response()->json($solicitudes);
//     }
    
    

// public function urgencia()
// {

//     $solicitudes = Solicitudes::where('modo', 'Urgencia')->paginate(1);

//     return view('docente.solicitud.filtrar.urgente', ['solicitudes' => $solicitudes]);
// }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request){
        // Validar los datos del formulario
        $id = Uuid::uuid4();
        $razones = new Razones();
        $solicitud = Solicitud::where('ID_SOLICITUD', $request->ID_SOLICITUD);
        try{
            $razones_no_reg = (isset($request->ACTUALIZACIONES->LISTA_NO_REG)) ? $razones->store($request->ACTUALIZACIONES->LISTA_NO_REG):null;
            $arreglo = ($request->ESTADO != 'ACEPTADO') ? array_merge($request->ACTUALIZACIONES['LISTA_REG'], $razones_no_reg):'Ninguno';
            Reserva::create([
                'ID_RESERVA' => $id,
                'ID_SOLICITUD' => $request->ID_SOLICITUD,
                'RAZONES' => json_encode($arreglo),
                'FECHAHORA_RESER' => date('Y-m-d')
            ]);
            $solicitud->update(['ESTADO'=> $request->ESTADO]);
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

    // public function filtrar_modo()
    // {
    //     // // Filtrar las solicitudes por modo "Urgente" y paginar el resultado
    //     $solicitudes = Solicitudes::where('modo', 'Urgente')->paginate(10);

    //     // Retornar la vista con las solicitudes filtradas y paginadas
    //     return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes]);
    //     // return "Hola";
    // }
    // public function filtrar_llegada()
    // {
    //     // // Filtrar las solicitudes por modo "Urgente" y paginar el resultado
    //     $solicitudes = Solicitudes::where('modo', 'Normal')->paginate(10);

    //     // Retornar la vista con las solicitudes filtradas y paginadas
    //     return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes]);
    //     // return "Hola";
    // }
    // public function filtrar()
    // {
    //     // Filtrar las solicitudes por estado diferente de "cancelado" y paginar el resultado
    //     $solicitudes = Solicitudes::where('estado', '!=', 'cancelado')->paginate(10);

    //     // Retornar la vista con las solicitudes filtradas y paginadas
    //     return view('docente.listar.cancelar', ['solicitudes' => $solicitudes]);
    // }
//Hu registro reservas
public function registroReservas()
{
    $nombreDocente = "Gelania";

    $solicitudes = Solicitudes::where('nombre', $nombreDocente)
        ->leftJoin('razones', 'solicitudes.id_razon', '=', 'razones.id_razones')
        ->select('solicitudes.*', 'razones.razon')
        ->paginate(10);
     $razon = Razones::paginate(10);
    // Retornar la vista con ambas variables
    return view('docente.registro.registroreservas', ['solicitudes' => $solicitudes, 'razon' => $razon]);
}

public function showReservas($id)
{

    $solicitud = Solicitudes::leftJoin('razones', 'solicitudes.id_razon', '=', 'razones.id_razones')
    ->where('solicitudes.id', $id)
    ->select('solicitudes.*', 'razones.razon')
    ->firstOrFail();


    return response()->json(['solicitud' => $solicitud]);
}




///registro de RazonDenoAsignacion


public function registroRazonDenoAsignacion()
{
    // Filtrar las solicitudes por el nombre del docente y paginar el resultado
    $solicitudes = Razones::paginate(10);

    // Envía los datos a la vista 'home'
    return view('docente.registro.registroRazonDenoAsignacion', ['solicitudes' => $solicitudes]);
}



public function  borrarRazon($id)
{
    dd($id);

    Razones::destroy($id);

 // Devuelve un mensaje de éxito como JSON
 return response()->json(['message' => 'Razón eliminada exitosamente']);
    }



}