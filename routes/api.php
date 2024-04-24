<?php

use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SolicitudController;

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
        Route::get('/ambientes', 'index');
        Route::post('/ambientes/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

Route::controller(HorarioController::class)->group(
    function(){
        Route::get('/horarios', 'index');
        Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);


Route::controller(NotificacionController::class)->group(
    function(){
        Route::get('/notificaciones', 'index');
        //Route::post('/horarios/store', 'store');
        // Route::post('/putambiente', 'show');
    }
);

