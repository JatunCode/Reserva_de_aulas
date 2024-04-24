<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Docente;
use App\Models\Admin\Notificacion;
use Illuminate\Http\Request;
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
        $notificaciones = Notificacion::with('docente_relacion_notificacion.notificaion_relacion_docente')->get();
        //return view('admin.notificaiones', ['notificaciones'=>$notificaciones]);
        return $notificaciones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Notificacion::create([
            'ID_NOTIFICACION' => Uuid::uuid4(),
            'CUERPO' => $request->cuerpo,
            'ID_DOCENTE' => Docente::where('NOMBRE', $request->docente)->ID_DOCENTE
        ]);


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
