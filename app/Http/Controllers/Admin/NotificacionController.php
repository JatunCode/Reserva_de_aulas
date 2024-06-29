<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Admin\Docente;
use App\Models\Admin\Notificacion as AdminNotificacion;
use App\Notifications\Notificacion;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;
use Ramsey\Uuid\Uuid;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = AdminNotificacion::with('docente_relacion_notificacion')->where('CUERPO', 'LIKE', '%PENDIENTE%')->get();
        $notificaciones_estructuradas = [];
        foreach ($notificaciones as $notify) {
            $hora_actual = new DateTime();
            $datos_docente = $notify['docente_relacion_notificacion'];
            $cuerpo = $this->quitarCaracteres($notify['CUERPO']);
            preg_match('/FECHA:\s*([0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2})/', $cuerpo, $matches);
            $fecha_reserva = DateTime::createFromFormat('Y-m-d H:i', $matches[1]);
            if(isset($datos_docente)){
                if($fecha_reserva > $hora_actual){
                    $notificaciones_estructuradas [] = [
                        'ID' => $notify['ID_NOTIFICACION'],
                        'CUERPO' => $cuerpo,
                        'NOMBRE_DOCENTE' => $datos_docente['NOMBRE'],
                        'EMAIL' => $datos_docente['EMAIL']
                    ];
                }
            }
        }
        return view('admin.mail.mailbox', ['notificationes'=>$notificaciones_estructuradas]);
        //return $notificaciones_estructuradas;
        //return view('vendor.mail.html.layout', ['slot' => 'Nombre de la persona que creo q es']);
    }

    function quitarCaracteres($input) {
        $regex = '/[^a-zA-Z0-9, \/:-]/';
        $cadena = preg_replace($regex, '', $input);
        return $cadena;
    }

    function reservasActuales(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscador = new EncontrarTodo();
        $fecha_actual = Date::now()->format('Y-m-d');
        $request = json_decode($request->getContent(), true);
        $nombres = json_decode($request['NOMBRES']);
        try {
            
            foreach($nombres as $nombre){
                $docenteId = $buscador->getIdDocenteporNombre($nombre);
                $docente = Docente::where('ID_DOCENTE',$docenteId)->first();
                AdminNotificacion::create([
                    'ID_NOTIFICACION' => Uuid::uuid4(),
                    'CUERPO' => json_encode(['FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE'], 'ESTADO' => (!isset($request['ESTADO']) ? 'PENDIENTE' : $request['ESTADO']), 'TIPO' => $request['TIPO'], 'MODO' => (strtotime($request['FECHA']) < strtotime($fecha_actual)) ? 'URGENTE':'NORMAL']),
                    'ID_DOCENTE' => $docenteId
                ]);
                Notification::route('mail', (($docente->EMAIL != '') ? $docente->EMAIL :'nombre@universidad.edu.bo'))->notify(new Notificacion($request['TIPO'], ['NOMBRE' => $nombre, 'ESTADO' => (!isset($request['ESTADO']) ? 'PENDIENTE' : $request['ESTADO']),'FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE'], 'RAZONES' => (isset($request['RAZONES'])) ? $request['RAZONES']['LISTA_REG'] : '']));
            }
    
            return response()->json(['message' => 'Notificacion creada exitosamente.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error al crear la notificacion. $th"], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
