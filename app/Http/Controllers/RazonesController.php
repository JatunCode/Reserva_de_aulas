<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Docente\Solicitudes;
use App\Models\Docente\Razones;
use Illuminate\Http\Request;

class RazonesController extends Controller
{




    ///registro de RazonDenoAsignacion


    public function registroRazonDenoAsignacion()
    {
        // Filtrar las solicitudes por el nombre del docente y paginar el resultado
        $solicitudes = Razones::paginate(10);

        return view('docente.registro.registroRazonDenoAsignacion', ['solicitudes' => $solicitudes]);
    }


    public function destroy($id)
    {

        $razon = Razones::where('id_razones', $id)->firstOrFail();

        $razon->delete();

        return redirect()->route('docente.registroRazonDenoAsignacion')->with('success', 'Registro eliminado correctamente');;

    }

    public function guardar(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'razon' => 'required|string|max:255',
        ]);

         // Crear una nueva instancia del modelo Razones y asignar los datos del formulario
         $razon = new Razones();
         $razon->razon = $request->input('razon');

         // Guardar la razón en la base de datos
         $razon->save();


        // Redireccionar a una ruta después de guardar la razón
        return redirect()->route('docente.registroRazonDenoAsignacion')->with('success', 'Razón guardada correctamente');
    }
}
