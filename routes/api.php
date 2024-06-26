<?php

use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Docente\CalendarioController;
use App\Http\Controllers\Docente\ReservasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\RazonesController;
use App\Http\Controllers\scripts\Automatizacion;
use App\Http\Controllers\scripts\EncontrarTodo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AmbienteController::class)->group(
    function(){
        Route::get('/fetch/ambientes', 'indexList');
        Route::get('/fetch/ambientestodos/{ambiente}/{materia}/{estado}', 'showTodo');
        Route::get('/fetch/ambientestodossin/{ambiente}/{materia}/{estado}', 'showTodo');
        Route::get('/fetch/ambientes/cantidad/{cantidad}', 'showCantidad');
        //Route::get('/fetch/ambientes/{id_ambiente}', 'showId');
        //Route::post('/ambientes/store', 'store');
        //Route::post('/putambiente', 'show');
    }
);

Route::controller(DocenteController::class)->group(
    function(){
        Route::get('/fetch/docentes', 'index');
        Route::put('/fetch/docente/{caracter}', 'show');
        Route::get('/fetch/docente/materias/grupos', 'showDocentesMaterias');
    }
);

Route::controller(HorarioController::class)->group(
    function(){
        Route::get('/horarios', 'index');
        Route::get('/fetch/horarios/libres/{ambiente}', 'indexList');
        Route::get('/fetch/horarios', 'indexFetch');
        Route::get('/fetch/horariostodos/{docente}/{dia}/{estado}', 'showTodo');
        Route::get('/fetch/horariostodossin/{docente}/{dia}/{estado}', 'showTodo');
        Route::put('/fetch/horarios/update', 'update');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(MateriaController::class)->group(
    function(){
        Route::get('/fetch/materias', 'index');
        Route::put('/fetch/materias/{nombre}', 'show');
        Route::put('/fetch/materias/{docente}', 'indexDocente');
        Route::get('/fetch/materias/grupos', 'showMateriasGrupos');
    }
);

Route::controller(NotificacionController::class)->group(
    function(){
        Route::get('/fetch/notificaciones', 'index');
        Route::post('/fetch/notificacion/store', 'store');
    }
);

Route::controller(ReservasController::class)->group(
    function(){
        Route::get('/fetch/reservas', 'index');
        Route::put('/fetch/reservas/store', 'store');
        Route::put('/fetch/reservas/update', 'update');
    }
);

Route::controller(SolicitudController::class)->group(
    function(){
        Route::get('/fetch/normal', 'normal');
        Route::get('/fetch/solicitudes', 'indexSolicitudes');
        Route::post('/fetch/solicitudes/store', 'store');
        Route::get('/fetch/solicitud/count', 'counts');
        Route::get('/fetch/solicitudeslibres/{ambiente}/{fecha}', 'solicitudes_libres');
    }
);

Route::controller(RazonesController::class)->group(
    function(){
        Route::get('/fetch/razones', 'indexList');
    }
);