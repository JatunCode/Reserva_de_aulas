<?php

use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\NotificacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Docente\SolicitudController;
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
        //Route::post('/ambientes/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(DocenteController::class)->group(
    function(){
        Route::get('/docentes', 'index');
        Route::put('/docente/{caracter}', 'show');
    }
);

Route::controller(HorarioController::class)->group(
    function(){
        Route::get('/horarios', 'index');
        Route::put('/horarios/libres/{ambiente}', 'indexList');
        Route::put('/horarios/{ambiente}', 'show');
        Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(MateriaController::class)->group(
    function(){
        Route::put('/materias/{nombre}', 'show');
        Route::put('/materias/{docente}', 'indexDocente');

    }
);

Route::controller(NotificacionController::class)->group(
    function(){
        Route::get('/notificaciones', 'index');
        //Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(SolicitudController::class)->group(
    function(){
        Route::get('/normal', 'normal');
        //Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);