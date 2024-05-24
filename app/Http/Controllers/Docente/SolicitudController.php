<?php

namespace App\Http\Controllers\Docente;
use DateTime;
use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Http\Controllers\scripts\GeneradorHorariosNoRegistrados;
use App\Models\Admin\Docente;
use App\Models\Admin\Horario;
use App\Models\Docente\Solicitudes;
use Illuminate\Http\Request;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Docente\Solicitud;
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
        $buscador = new EncontrarTodo();
        $nombres = [];
        $nombres_ambiente = [];
        $solicitudes_fetch = Solicitud::all();

        foreach($solicitudes_fetch as $solicitud){
            $nombres[] = $buscador->getNombreDocentesporID($solicitud->ID_DOCENTE_s);
            $nombres_ambiente[] = $buscador->getNombreAmbiente($solicitud->ID_AMBIENTE);
        }

        $json = [
            "solicitudes de un docente" => $solicitudes_fetch,
            "Nombres de los docentes por solicitud" => $nombres,
            "Nombre de los ambientes" => $nombres_ambiente
        ];
        return json_encode($json);
        //return view('docente.home', compact('eventos_json', 'solicitudes','pendientesCount', 'urgentesCount', 'reservadasCount'));
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
        $idDocente = '354db6b6-be0f-4aca-a9ea-3c31e412c49d';
        $buscardor = new EncontrarTodo();
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
        $uuid = Uuid::uuid4();
        
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

        // try {
        //     $request->validate([
        //         'NOMBRES' => ['required', 
        //             function($attribute, $value, $fail){
        //                 $decoder = json_decode($attribute, true);
        //                 if(!is_array($decoder) || count($decoder) < 1 || count($decoder) > 4){
        //                     $fail($attribute.' debe contener un docente al menos.');
        //                 }
        //             }],
        //         'CANTIDAD' => 'required|integer',
        //         'FECHA_RESERVA' => 'required|date_format:Y-m-d H:i:s',
        //         'HORA_INICIO' => 'required|date_format:H:i:s',
        //         'HORA_FIN' => 'required|date_format:H:i:s',
        //         'PRIORIDAD' => 'required',
        //         'MOTIVO' => 'required|string',
        //         'MATERIA' => 'required|string',
        //         'AMBIENTE' => 'required|string'
        //     ]);

        //     $idsygruposDocente = $buscardor->getGruposyIdsDocentes($request->NOMBRES);
        //     Solicitud::create([
        //         'ID_SOLICITUD' => $uuid->toString(),
        //         'ID_DOCENTES' => $idsygruposDocente[0],
        //         'CANTIDAD_EST' => $request->CANTIDAD,
        //         'FECHA_RE' => $request->FECHA_RESERVA,
        //         'HORAINI' => $request->HORA_INICIO,
        //         'HORAFIN' => $request->HORA_FIN,
        //         'FECHAHORA_SOLI' => Date::now(),
        //         'MOTIVO' => $request->MOTIVO,
        //         'PRIORIDAD' => json_encode($request->PRIORIDAD),
        //         'ID_MATERIA' => $buscardor->getIdMateria($request->MATERIA),
        //         'GRUPOS' => $idsygruposDocente[1],
        //         'ID_AMBIENTE' => $buscardor->getIdAmbiente($request->AMBIENTE),
        //         'ESTADO' => 'PENDIENTE'
        //     ]);
        //     return response()->json(["message" => "Horario creado exitosamente"], 200);
        // } catch (\Exception $e) {
        //     //return redirect()->back()->withInput()->withErrors(['error' => 'Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
        //     return response()->json(["message" => "Hubo un error en el servidor: \n $e"], 500);
        // }
     }
     
    //Se debe realizar dos uno en el que se sepa que es admin y otro para docente
    /**
     * @param Request debe ser el id o el nombre del docente
     * @return response mostrar los datos del docente en el registro
     */
    public function docente_datos(Request $request)
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
            // Iterar sobre las materias para obtener sus nombres
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
        
        return view('docente.solicitud.normal', ['solicitudes' => $solicitudes,'materias' => $materiasAsociadas]);
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

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Admin\Solicitud  $solicitud
    //  * !!!!!!!!se debe encontrar la solicitud por el id es un error 
    //  * !!!!!!!!de seguridad mandar toda la solicitud al servidor es mucha carga
    //  * !!!!!!!!para el servidor en que mierda piensas >:v
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function update(Request $request, Solicitud $solicitud)
    // {
    //     $request->validate([
    //         'nombre' => 'required|string',
    //         'materia' => 'required|string',
    //         'grupo' => 'required|string',
    //         'cantidad_estudiantes' => 'required|integer',
    //         'motivo' => 'required|string',
    //         'modo' => 'required|string',
    //         'razon' => 'nullable|string',
    //     ]);

    //     $solicitud->update($request->all());

    //     return response()->json(['message' => 'Solicitud actualizada exitosamente', 'solicitud' => $solicitud]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Solicitud  $solicitud
     * !!!!!!!!se debe encontrar la solicitud por el id es un error 
     * !!!!!!!!de seguridad mandar toda la solicitud al servidor es mucha carga
     * !!!!!!!!para el servidor en que mierda piensas >:v
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'ID_SOLICITUD' => 'required|string',
            'ESTADO' => 'required|string'
        ]);

        $solicitud = Solicitud::where('ID_SOLICITUD', $request->ID_SOLICUTD)->update('ESTADO', $request->ESTADO);

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
