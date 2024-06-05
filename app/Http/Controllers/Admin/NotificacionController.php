<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\scripts\EncontrarTodo;
use App\Models\Admin\Docente;
use App\Models\Admin\Notificacion as AdminNotificacion;
use App\Notifications\Notificacion;
use Dotenv\Repository\Adapter\EnvConstAdapter;
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
        // $notificaciones = AdminNotificacion::with('docente_relacion_notificacion.notificaion_relacion_docente')->get();
        // return view('admin.mail.mailbox', ['notificaciones'=>$notificaciones]);
        //return $notificaciones;
        //return view('vendor.mail.html.layout', ['slot' => 'Nombre de la persona que creo q es']);
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
                Notification::route('mail', (($docente->EMAIL != '') ? $docente->EMAIL :'nombre@universidad.edu.bo'))->notify(new Notificacion($request['TIPO'], ['NOMBRE' => $nombre, 'FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE']]));
                AdminNotificacion::create([
                    'ID_NOTIFICACION' => Uuid::uuid4(),
                    'CUERPO' => json_encode(['FECHA' => $request['FECHA'], 'MATERIA' => $request['MATERIA'], 'AMBIENTE' => $request['AMBIENTE']]),
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
