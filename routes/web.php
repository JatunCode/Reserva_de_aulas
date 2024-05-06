<?php

use App\Http\Controllers\Admin\AmbienteController;
use App\Http\Controllers\Admin\DocenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\Docente\ReservasController;
use App\Models\Admin\Docente;
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
    Route::get('/auth/login', function () {
        return view('auth.login');
    });
    Route::get('/', function () {
        return view('welcome');
    });


});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', [SolicitudController::class, 'index'])->name('admin.home');
    // Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
    // Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/ambientes', [AmbienteController::class, 'index'])->name('admin.ambientes');
    Route::get('/ambientes/registro', [AmbienteController::class, 'store'])->name('ambiente.list');
    Route::post('/ambientes/store', [AmbienteController::class, 'store'])->name('ambiente.store');
    Route::put('/ambientes/show/{nombre}', [AmbienteController::class, 'show'])->name('ambiente.put');
    Route::get('/horarios', [HorarioController::class, 'index'])->name('admin.horarios');
    Route::get('/horarios/registro', [HorarioController::class, 'store'])->name('horario.list');
    Route::post('/horarios/store', [HorarioController::class, 'store'])->name('horario.store');
    Route::put('/horarios/show/{materia}', [HorarioController::class, 'show_materia'])->name('horario.put.materia');
    Route::put('/horarios/show/{ambiente}', [HorarioController::class, 'show_ambiente'])->name('horario.put.ambiente');
    Route::put('/docentes/show/{caracter}', [DocenteController::class, 'show'])->name('docente.put');
    Route::get('/hola',  function () {
        return 'Hola :v';
    });
});

// Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
Route::prefix('docente')->group(function () {
    Route::get('/', [SolicitudController::class, 'index'])->name('docente.inicio');
    Route::get('/solicitud/normal/hola', [SolicitudController::class, 'fecha'])->name('docente.solicitud.fecha');
    Route::get('/solicitud/normal/', [SolicitudController::class, 'docente_datos'])->name('docente.solicitud.normal');
    Route::get('/solicitud/urgente', [SolicitudController::class, 'urgente'])->name('docente.solicitud.urgente');
    Route::get('/solicitudes/urgencia', [ReservasController::class, 'filtrar_modo'])->name('docente.solicitud.filtrar.urgente');
    Route::get('/solicitudes/listar', [ReservasController::class, 'datos'])->name('docente.solicitud.filtrar.datos');
    Route::get('/solicitudes/listar/cancelar', [ReservasController::class, 'datos_cancelar'])->name('docente.solicitud.filtrar.datos_cancelar');
    Route::get('/solicitudes/listar/pendiente', [ReservasController::class, 'datos_solicitando'])->name('docente.solicitud.filtrar.datos_solicitando');
    Route::get('/solicitudes/listar/reservado', [ReservasController::class, 'datos_reservado'])->name('docente.solicitud.filtrar.datos_reservado');
    
    Route::get('/solicitudes/listar_filtro', [ReservasController::class, 'datos_filtro'])->name('docente.solicitud.filtrar.datos_filtro');
    
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/reservas', [ReservasController::class, 'index'])->name('docente.reservas');
    Route::get('/reservas/{id}', [ReservasController::class, 'show'])->name('docente.reservas.show');
    Route::get('/solicitudes/cancelar', [ReservasController::class, 'cancelar_solicitud'])->name('docente.solicitud.cancelar');
    Route::put('/solicitudes/{solicitud}/cancelar', [ReservasController::class, 'cancelar'])->name('docente.reservas.cancelar');
 //Hu registro reservas
 Route::get('/registroReservas', [ReservasController::class, 'registroReservas'])->name('docente.registroReservas');
 Route::get('/registroRazonDenoAsignacion', [ReservasController::class, 'registroRazonDenoAsignacion'])->name('docente.registroRazonDenoAsignacion');
 Route::get('/registroRazonDenoAsignacion/{id}', [ReservasController::class, 'showReservas'])->name('docente.reservas.showReservas');
});


