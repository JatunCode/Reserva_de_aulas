<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Docente\Solicitudes;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Docente\Razones;
use App\Models\Docente\Solicitud;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $solicitudes = Solicitud::where('ESTADO', 'PENDIENTE')->get();
        $nombres_docentes = [];
        $todo = [];
        $buscador = new EncontrarTodo();
        foreach($solicitudes as $solicitud){
            $ids = $solicitud['ID_DOCENTE_s'];
            $nombres_docentes[] = $buscador->getNombreDocentes($ids);
        }
        $todo[] = $solicitudes;
        $todo[] = $nombres_docentes;
        //return json_encode($todo);
        return view('admin.reservas', ['solicitudes' => Solicitudes::where('ESTADO', 'PENDIENTE')]);
    }
   
    public function datos(Request $request)
    {
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

        // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
        // Construir la consulta base
        $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
        $materiasAsociadas = [];
        foreach ($relaciones as $relacion) {
        // Obtener la colección de materias asociadas a través de la relación
            // Iterar sobre las materias para obtener sus nombres
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
        

        

        // Devolver las solicitudes como respuesta en formato JSON
        return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }
    public function datos_cancelar(Request $request)
    {
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

        // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
        // Construir la consulta base
        $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
        ->where('estado', 'cancelado')
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
           // Devolver las solicitudes como respuesta en formato JSON
        return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }
    public function datos_solicitando(Request $request)
    {
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

        // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
        // Construir la consulta base
        $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)
        ->where('estado', 'Solicitando')
        ->get();
        $materiasAsociadas = [];
        foreach ($relaciones as $relacion) {
            // Obtener la colección de materias asociadas a través de la relación
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
           // Devolver las solicitudes como respuesta en formato JSON
        return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }
    public function datos_reservado(Request $request)
    {
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
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
           // Devolver las solicitudes como respuesta en formato JSON
        return view('docente.listar.solicitudes', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }
    public function cancelar_solicitud(Request $request)
    {
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d'; // Este ID debe ser el del docente específico que deseas consultar

        // Obtener las relaciones Relacion_DAHM asociadas con el docente específico
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')
                                    ->where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d')
                                    ->get();
        // Construir la consulta base
        $solicitudes = Solicitudes::where('ID_DOCENTE', $idDocente)->get();
        $materiasAsociadas = [];
        foreach ($relaciones as $relacion) {
            // Iterar sobre las materias para obtener sus nombres
            foreach ($relaciones as $relacion) {
                // Obtener la colección de materias asociadas a través de la relación
                $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
                if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                    $materiasAsociadas[] = $nombreMateria;
                }
            }
        }
                

        

        // Devolver las solicitudes como respuesta en formato JSON
        return view('docente.listar.cancelar', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
    }
    public function datos_filtro(Request $request)
    {
 
        $filtroModo = $request->input('modo');
        $filtroEstado = $request->input('estado');
        $filtroMateria = $request->input('materia');
        // Construir la consulta base
        $query = Solicitudes::where('ID_DOCENTE', '354db6b6-be0f-4aca-a9ea-3c31e412c49d');
        
        // Aplicar filtros si están presentes
   
        if ($filtroMateria!==null) {
            $query->where('materia', $filtroMateria);
        }
           
        
        if ($filtroModo!== "Todos") {
            $query->where('modo', $filtroModo);
        }
        // Aplicar el filtro de estado solo si es diferente de "Todos"
        if ($filtroEstado !== "Todos") {
            
            $query->where('estado', $filtroEstado);
        }
        
        // Obtener las solicitudes filtradas
        $solicitudes = $query->get();
        
        // Devolver las solicitudes filtradas como respuesta en formato JSON
        return response()->json($solicitudes);
    }
    
    

public function urgencia()
{

    $solicitudes = Solicitudes::where('modo', 'Urgencia')->paginate(1);

    return view('docente.solicitud.filtrar.urgente', ['solicitudes' => $solicitudes]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

public function store(Request $request){
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

    // Crear una nueva instancia de la solicitud
    $solicitud = new Solicitudes;
    $solicitud->nombre = $request->input('nombre');
    $solicitud->materia = $request->input('materia');
    $solicitud->grupo = $request->input('grupo');
    $solicitud->cantidad_estudiantes = $request->input('cantidad_estudiantes');
    $solicitud->motivo = $request->input('motivo');
    $solicitud->modo = $request->input('modo');
    $solicitud->razon = $request->input('razon');
    $solicitud->aula = $request->input('aula');
    $solicitud->horario = $request->input('horario');
    $solicitud->fecha = $request->input('fecha'); // Asegúrate de obtener correctamente el valor de 'fecha'
    $solicitud->estado = $request->input('estado');
    // Guardar la solicitud en la base de datos
    $solicitud->save();

    // Redirigir a la página de inicio del administrador
    return redirect()->route('docente.solicitud.normal')->with('success', 'Solicitud creada exitosamente');

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