<?php

use App\Http\Controllers\Admin\AmbienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\Docente\ReservasController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('welcome');
    });


});

Auth::routes();

Route::prefix('admin')->group(function () {
    // Route::get('/', [SolicitudController::class, 'index'])->name('admin.home');
    // Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
    // Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/ambientes', [AmbienteController::class, 'index'])->name('admin.ambientes');
    Route::post('/ambientes/store', [AmbienteController::class, 'store'])->name('ambiente.store');
    Route::put('/ambientes/show/{nombre}', [AmbienteController::class, 'show'])->name('ambiente.put');
    Route::get('/horarios', [HorarioController::class, 'index'])->name('admin.horarios');
    Route::post('/horarios/store', [HorarioController::class, 'store'])->name('horario.store');
    Route::put('/horarios/show/{materia}', [HorarioController::class, 'show_materia'])->name('horario.put.materia');
    Route::put('/horarios/show/{ambiente}', [HorarioController::class, 'show_ambiente'])->name('horario.put.ambiente');
    Route::get('/hola',  function () {
        return 'Hola :v';
    });

});
// Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
Route::prefix('docente')->group(function () {
    Route::get('/', [SolicitudController::class, 'index'])->name('docente.solicitudes.disponibles');
    Route::get('/solicitud/normal/hola', [SolicitudController::class, 'fecha'])->name('docente.solicitud.fecha');
    Route::get('/solicitud/normal/', [SolicitudController::class, 'normal'])->name('docente.solicitud.normal');
    Route::get('/solicitud/urgente', [SolicitudController::class, 'urgente'])->name('docente.solicitud.urgente');
    Route::get('/solicitudes/urgencia', [ReservasController::class, 'filtrar_modo'])->name('docente.solicitud.filtrar.urgente');
    Route::get('/solicitudes/llegada', [ReservasController::class, 'filtrar_llegada'])->name('docente.solicitud.filtrar.llegada');
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/reservas', [ReservasController::class, 'index'])->name('docente.reservas');
    Route::get('/reservas/{id}', [ReservasController::class, 'show'])->name('docente.reservas.show');
    Route::get('/solicitudes/cancelar', [ReservasController::class, 'filtrar'])->name('docente.solicitud.cancelar');
    Route::put('/solicitudes/{solicitud}/cancelar', [ReservasController::class, 'cancelar'])->name('docente.reservas.cancelar');
});



