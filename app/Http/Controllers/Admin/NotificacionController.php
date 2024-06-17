<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Admin\Docente;
use App\Models\Admin\Notificacion as AdminNotificacion;
use App\Notifications\Notificacion;
use Illuminate\Http\Request;
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
        $notificaciones = AdminNotificacion::with('docente_relacion_notificacion')->get();
        $notificaciones_estructuradas = [];
        foreach ($notificaciones as $notify) {
            $datos_docente = $notify['docente_relacion_notificacion'];
            if(isset($datos_docente)){
                $notificaciones_estructuradas [] = [
                    'ID' => $notify['ID_NOTIFICACION'],
                    'CUERPO' => $this->quitarCaracteres($notify['CUERPO']),
                    'NOMBRE_DOCENTE' => $datos_docente['NOMBRE'],
                    'EMAIL' => $datos_docente['EMAIL']
                ];
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buscador = new EncontrarTodo();
        $request = json_decode($request->getContent(), true);
        $nombres = json_decode($request['NOMBRES']);
        try {
            
            foreach($nombres as $nombre){
                $docenteId = $buscador->getIdDocenteporNombre($nombre);
                $docente = Docente::where('ID_DOCENTE',$docenteId)->first();
                Notification::route('mail', (($docente->EMAIL != '') ? $docente->EMAIL :'nombre@universidad.edu.bo'))->notify(new Notificacion($request['TIPO'], ['NOMBRE' => $nombre, 'ESTADO' => (!isset($request['ESTADO']) ? 'PENDIENTE' : $request['ESTADO']),'FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE'], 'RAZONES' => (isset($request['RAZONES'])) ? $request['RAZONES']['LISTA_REG'] : '']));
                AdminNotificacion::create([
                    'ID_NOTIFICACION' => Uuid::uuid4(),
                    'CUERPO' => json_encode(['FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE'], 'ESTADO' => (!isset($request['ESTADO']) ? 'PENDIENTE' : $request['ESTADO']), 'TIPO' => $request['TIPO']]),
                    'ID_DOCENTE' => $docenteId
                ]);
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
