<?php

use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Docente\ReservasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\RazonesController;
use App\Models\Docente\Solicitud;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AmbienteController::class)->group(
    function(){
        Route::get('/fetch/ambientes', 'indexList');
        Route::get('/fetch/ambientestodos/{ambiente}/{materia}/{estado}', 'showTodo');
        Route::get('/fetch/ambientestodossin/{ambiente}/{materia}/{estado}', 'showTodo');
        //Route::get('/fetch/ambientes/{id_ambiente}', 'showId');
        //Route::post('/ambientes/store', 'store');
        //Route::post('/putambiente', 'show');
    }
);

Route::controller(DocenteController::class)->group(
    function(){
        Route::get('/fetch/docentes', 'index');
        Route::put('/docente/{caracter}', 'show');
    }
);

Route::controller(HorarioController::class)->group(
    function(){
        Route::get('/horarios', 'index');
        Route::get('/fetch/horarios/libres/{ambiente}', 'indexList');
        Route::get('/fetch/horarios', 'indexFetch');
        Route::get('/fetch/horarios/{ambiente}', 'show');
        Route::get('/fetch/horariostodos/{docente}/{dia}/{estado}', 'showTodo');
        Route::get('/fetch/horariostodossin/{docente}/{dia}/{estado}', 'showTodo');
        Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(MateriaController::class)->group(
    function(){
        Route::get('/fetch/materias', 'index');
        Route::put('/fetch/materias/{nombre}', 'show');
        Route::put('/fetch/materias/{docente}', 'indexDocente');

    }
);

Route::controller(NotificacionController::class)->group(
    function(){
        Route::get('/notificaciones', 'index');
        //Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(ReservasController::class)->group(
    function(){
        Route::get('/fetch/reservas', 'index');
        Route::put('/fetch/reservas/store', 'store');
    }
);

Route::controller(SolicitudController::class)->group(
    function(){
        Route::get('/fetch/normal', 'normal');
        Route::get('/fetch/solicitudes', 'index');
        Route::post('/fetch/solicitudes/store', 'store');
        Route::get('/fetch/solicitudeslibres/{ambiente}/{fecha}', 'solicitudes_libres');
        Route::get('/fetch/solicitudesshow/{ambiente}', 'show');
        Route::get('/fetch/reservas/{docente}/{materia}/{modo}', 'showAtencion');
        //Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(RazonesController::class)->group(
    function(){
        Route::get('/fetch/razones', 'indexList');
    }
);