<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Relacion_DAHM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Ambiente;
use App\Models\Docente\Solicitud;
use App\Models\Admin\Materia;

class ListarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $ambientes = Ambiente::all();
        // return view('admin.listar.solicitudes', ['ambientes' => $ambientes]);
    }

    public function datos(Request $request)
    {
        // Obtener todas las relaciones Relacion_DAHM
        $relaciones = Relacion_DAHM::with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia')->get();
    
        // Obtener todas las solicitudes
        $solicitudes = Solicitud::all();
    
        // Construir la lista de materias asociadas
        $materiasAsociadas = [];
        foreach ($relaciones as $relacion) {
            $nombreMateria = $relacion->dahm_relacion_materia->NOMBRE;
            if ($nombreMateria && !in_array($nombreMateria, $materiasAsociadas, true)) {
                $materiasAsociadas[] = $nombreMateria;
            }
        }
    
        // Devolver las solicitudes y las materias como respuesta en la vista
        return view('admin.listar.solicitudes', ['solicitudes' => $solicitudes, 'materias' => $materiasAsociadas]);
    }

    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return response()->json(['solicitud' => $solicitud]);
    }

    public function datos_filtro(Request $request)
    {
        $filtroModo = $request->input('modo');
        $filtroEstado = $request->input('estado');
        $filtroMateria = $request->input('materia');

        // Construir la consulta base
        $query = Solicitud::query();
        
        // Aplicar filtros si están presentes
        if ($filtroMateria !== null) {
            $query->whereHas('solicitud_relacion_materia', function ($query) use ($filtroMateria) {
                $query->where('NOMBRE', $filtroMateria);
            });
        }
        
        if ($filtroModo !== "Todos") {
            $query->where('modo', $filtroModo);
        }
        
        if ($filtroEstado !== "Todos") {
            $query->where('ESTADO', $filtroEstado);
        }
        
        // Obtener las solicitudes filtradas
        $solicitudes = $query->get();
        
        // Devolver las solicitudes filtradas como respuesta en formato JSON
        return response()->json($solicitudes);
    }
}
