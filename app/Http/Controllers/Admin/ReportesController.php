<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Ambiente;
use App\Models\Admin\Docente;
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
    try {
        // Obtener los filtros enviados desde el formulario
        $nombreAmbiente = $request->input('nombre');
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
        
        // Obtener las solicitudes asociadas a los ambientes filtrados
        foreach ($ambientesFiltrados as $ambiente) {
            $solicitudes = Solicitudes::where('ID_AMBIENTE', $ambiente->ID_AMBIENTE)->get();
            $ambiente->solicitudes = $solicitudes;
        }
        
        // Devolver los ambientes filtrados con las solicitudes asociadas como respuesta en formato JSON
        return response()->json($ambientesFiltrados);
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
    // Obtener los datos enviados desde JavaScript
    $data = $request->query('data');

    // Decodificar los datos JSON recibidos
    $datos = json_decode($data);

    // Extraer los valores de los datos
    $nombreAmbiente = $datos->nombre;
    $estadoAmbiente = $datos->estado;
    $capacidadAmbiente = $datos->capacidad;
        
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
        
    // Obtener las solicitudes asociadas a los ambientes filtrados
    foreach ($ambientesFiltrados as $ambiente) {
        $solicitudes = Solicitudes::where('ID_AMBIENTE', $ambiente->ID_AMBIENTE)->get();
        $ambiente->solicitudes = $solicitudes;
    }
        
    // Generar el contenido HTML para el PDF
    $html = view('admin.reportes.pdf', ['tabla' => $ambientesFiltrados, 'datos' => $datos])->render();

    // Cargar el contenido HTML en Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Opcional: configurar opciones, como tamaño de página, orientación, etc.
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf->setOptions($options);

    // Renderizar el PDF
    $dompdf->render();

    // Descargar el PDF al navegador del usuario
    return $dompdf->stream('nombre-del-archivo.pdf');
}
}
