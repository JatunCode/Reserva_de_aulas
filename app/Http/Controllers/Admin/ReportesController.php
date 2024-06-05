<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Materia;
use App\Models\Docente\Solicitudes;
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
    
    public function datos_filtro(Request $request)
    {
        // Obtener los filtros enviados desde el formulario
        $nombreAmbiente = $request->input('nombre'); // Cambiar 'ambiente' por 'nombre'
        $estadoAmbiente = $request->input('estado');
        $capacidadAmbiente = $request->input('capacidad');
        
        // Construir la consulta base para los ambientes
        $queryAmbientes = Ambiente::query();
        
        // Aplicar filtros si están presentes
        if ($nombreAmbiente !== null) {
            $queryAmbientes->where('NOMBRE', 'LIKE', "%$nombreAmbiente%");
        }
        
        if ($estadoAmbiente !== 'Todos') {
            $queryAmbientes->where('ESTADO', $estadoAmbiente);
        }
        
        if ($capacidadAmbiente !== null) {
            $queryAmbientes->where('CAPACIDAD', $capacidadAmbiente);
        }
        
        // Obtener los ambientes filtrados
        $ambientesFiltrados = $queryAmbientes->get();
        
        // Devolver los ambientes filtrados como respuesta en formato JSON
        return response()->json($ambientesFiltrados);
    }
    public function obtenerNombresAmbientes()
{
    $nombresAmbientes = Ambiente::pluck('NOMBRE')->toArray();
    return response()->json($nombresAmbientes);
}
public function exportarPDF(Request $request)
{
    // Obtener los datos de la solicitud
    $datos = json_decode($request->input('data'), true);
        $tabla = $datos['tabla'];
    $ambientes = Ambiente::all();
    // Crear una nueva instancia de Dompdf
    $dompdf = new Dompdf();

    // Opcional: configurar opciones, como tamaño de página, orientación, etc.
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf->setOptions($options);

    // Generar el contenido HTML para el PDF
    $html = view('admin.reportes.pdf', ['tabla' => $ambientes ,'datos' => $datos], compact('datos'))->render();

    // Cargar el contenido HTML en Dompdf
    $dompdf->loadHtml($html);

    // Renderizar el PDF
    $dompdf->render();

    // Descargar el PDF al navegador del usuario
    return $dompdf->stream('nombre-del-archivo.pdf');
}
}
