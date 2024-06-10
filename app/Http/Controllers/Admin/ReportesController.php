<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Relacion_DAHM;
use App\Models\Admin\Docente;
use App\Models\Admin\Materia;
use App\Models\Docente\Solicitud;
use Dompdf\Dompdf;
use Dompdf\Options;
class ReportesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function datos(Request $request)
    {
        $ambientes = Ambiente::all();
        $materias = Materia::all();
        return view('admin.reportes.reportes', ['ambientes' => $ambientes, 'materias' => $materias]);
    }
    
    // public function datos_filtro(Request $request)
    // {
    //     try {
    //         // Obtener los filtros enviados desde el formulario
    //         $nombreAmbiente = $request->input('nombre');
    //         $estadoAmbiente = $request->input('estado');
    //         $capacidadAmbiente = $request->input('capacidad');
    //         $fechaDesde = $request->input('fechaDesde');
    //         $fechaHasta = $request->input('fechaHasta');
            
    //         // Construir la consulta base para los ambientes
    //         $queryAmbientes = Ambiente::query();
            
    //         // Aplicar filtros si están presentes
    //         if ($nombreAmbiente !== null) {
    //             $queryAmbientes->where('NOMBRE', 'LIKE', "%$nombreAmbiente%");
    //         }
            
    //         if ($estadoAmbiente !== 'Todos') {
    //             $queryAmbientes->where('ESTADO', $estadoAmbiente);
    //         }
            
    //         if ($capacidadAmbiente !== null) {
    //             $queryAmbientes->where('CAPACIDAD', $capacidadAmbiente);
    //         }
            
    //         // Obtener los ambientes filtrados
    //         $ambientesFiltrados = $queryAmbientes->get();
            
    //         // Obtener las solicitudes asociadas a los ambientes filtrados y aplicar el filtro de fecha
    //         foreach ($ambientesFiltrados as $ambiente) {
    //             $solicitudesQuery = Solicitud::where('ID_AMBIENTE', $ambiente->ID_AMBIENTE);
                
    //             if ($fechaDesde !== null) {
    //                 $solicitudesQuery->whereDate('fecha', '>=', $fechaDesde);
    //             }
                
    //             if ($fechaHasta !== null) {
    //                 // Si solo se selecciona fecha hasta, buscar desde esa fecha hasta la actual
    //                 if ($fechaDesde === null) {
    //                     $fechaDesde = Carbon::now(); // Por ejemplo, si queremos buscar desde hace 30 días
    //                 }
    //                 $solicitudesQuery->whereBetween('fecha', [$fechaDesde, $fechaHasta]);
    //             }
                
    //             $solicitudes = $solicitudesQuery->get();
                
    //             // Obtener el docente asociado a cada solicitud
                
                
    //             $ambiente->solicitudes = $solicitudes;
    //         }
            
    //         // Devolver los ambientes filtrados con las solicitudes asociadas como respuesta en formato JSON
    //         return response()->json($ambientesFiltrados);
    //     } catch (\Exception $e) {
    //         // En caso de error, devolver una respuesta JSON con un mensaje de error
    //         return response()->json(['error' => 'Ocurrió un error al procesar la solicitud'], 500);
    //     }
    // }
    public function datos_filtro(Request $request)
{
    try {
        // Obtener los filtros enviados desde el formulario
        $nombreAmbiente = $request->input('nombre');
        $estadoAmbiente = $request->input('estado');
        $capacidadAmbiente = $request->input('capacidad');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        
        // Construir la consulta base para las relaciones DAHM
        $queryRelaciones = Relacion_DAHM::query();
        
        // Aplicar filtros si están presentes
        if ($nombreAmbiente !== null) {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($nombreAmbiente) {
                $query->where('NOMBRE', 'LIKE', "%$nombreAmbiente%");
            });
        }
        
        if ($estadoAmbiente !== 'Todos') {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($estadoAmbiente) {
                $query->where('ESTADO', $estadoAmbiente);
            });
        }
        
        if ($capacidadAmbiente !== null) {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($capacidadAmbiente) {
                $query->where('CAPACIDAD', $capacidadAmbiente);
            });
        }
        
        // Obtener todos los datos de Relacion_DAHM con sus relaciones cargadas y aplicando los filtros
        $relaciones = $queryRelaciones->with('dahm_relacion_horario', 'dahm_relacion_ambiente', 'dahm_relacion_materia', 'dahm_relacion_docente')->get();
        
        // Obtener las solicitudes asociadas a las relaciones DAHM y aplicar el filtro de fecha
        foreach ($relaciones as $relacion) {
            $solicitudesQuery = Solicitud::where('ID_AMBIENTE', $relacion->dahm_relacion_ambiente->ID_AMBIENTE);
            
            if ($fechaDesde !== null) {
                $solicitudesQuery->whereDate('fecha', '>=', $fechaDesde);
            }
            
            if ($fechaHasta !== null) {
                $solicitudesQuery->whereDate('fecha', '<=', $fechaHasta);
            }
            
            // Asignar las solicitudes a la relación DAHM
            $relacion->solicitudes = $solicitudesQuery->get();
        }
        
        // Eliminar relaciones duplicadas basadas en el ID_AMBIENTE
        $relaciones = $relaciones->unique('ID_AMBIENTE');
        
        // Devolver los datos de Relacion_DAHM con sus relaciones y filtros aplicados como respuesta en formato JSON
        return response()->json($relaciones);
    } catch (\Exception $e) {
        // En caso de error, devolver una respuesta JSON con un mensaje de error
        return response()->json(['error' => 'Ocurrió un error al procesar la solicitud'], 500);
    }
}

    
    
    
    

    

    public function obtenerNombresAmbientes()
{
    $nombresAmbientes = Ambiente::pluck('NOMBRE')->toArray();
    return response()->json($nombresAmbientes);
}
public function exportarPDF(Request $request)
{
    try {
        $data = $request->input('data');
        $datos = json_decode($data);
        
        // Obtener los filtros enviados desde el formulario
        $nombreAmbiente = $datos->nombre;
        $estadoAmbiente = $datos->estado;
        $capacidadAmbiente = $datos->capacidad;
        $fechaDesdeAmbiente = $datos->fechaDesde;
        $fechaHastaAmbiente = $datos->fechaHasta;
        
        // Construir la consulta base para las relaciones DAHM
        $queryRelaciones = Relacion_DAHM::query();
        
        // Aplicar filtros si están presentes
        if (!empty($nombreAmbiente)) {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($nombreAmbiente) {
                $query->where('NOMBRE', 'LIKE', "%$nombreAmbiente%");
            });
        }
        
        if ($estadoAmbiente !== 'Todos') {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($estadoAmbiente) {
                $query->where('ESTADO', $estadoAmbiente);
            });
        }
        
        if (!empty($capacidadAmbiente)) {
            $queryRelaciones->whereHas('dahm_relacion_ambiente', function ($query) use ($capacidadAmbiente) {
                $query->where('CAPACIDAD', $capacidadAmbiente);
            });
        }

        // Obtener las relaciones DAHM filtradas y agrupar por ID de ambiente para evitar duplicados
        $relaciones = $queryRelaciones->with('dahm_relacion_ambiente')->get()->unique('dahm_relacion_ambiente.ID_AMBIENTE');

        // Para cada relación, obtener y asignar las solicitudes
        foreach ($relaciones as $relacion) {
            $solicitudesQuery = Solicitud::where('ID_AMBIENTE', $relacion->dahm_relacion_ambiente->ID_AMBIENTE);

            if (!empty($fechaDesdeAmbiente)) {
                $solicitudesQuery->whereDate('fecha', '>=', $fechaDesdeAmbiente);
            }

            if (!empty($fechaHastaAmbiente)) {
                $solicitudesQuery->whereDate('fecha', '<=', $fechaHastaAmbiente);
            }

            // Asignar las solicitudes a la relación DAHM
            $relacion->solicitudes = $solicitudesQuery->get();
        }

        // Generar el contenido HTML para el PDF
        $html = view('admin.reportes.pdf', ['tabla' => $relaciones, 'datos' => $datos])->render();

        // Cargar el contenido HTML en Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Opcional: configurar opciones de Dompdf, como tamaño de página, orientación, etc.
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf->setOptions($options);

        // Renderizar el PDF
        $dompdf->render();

        // Descargar el PDF al navegador del usuario
        return $dompdf->stream('nombre-del-archivo.pdf');
    } catch (\Exception $e) {
        // En caso de error, devolver una respuesta JSON con un mensaje de error
        return response()->json(['error' => 'Ocurrió un error al procesar el PDF: ' . $e->getMessage()], 500);
    }
}











}
