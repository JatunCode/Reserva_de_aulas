<?php

use App\Http\Controllers\Admin\AmbienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Admin\ListarController;
use App\Http\Controllers\Admin\ReportesController;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\Docente\CalendarioController;
use App\Http\Controllers\Docente\ReservasController;
use App\Http\Controllers\MapaControler;
use App\Http\Controllers\RazonesController;
use App\Models\Admin\Docente;
use App\Models\Docente\Solicitud;
use Illuminate\Support\Facades\Auth;
use Cornford\Googlmapper\Facades\MapperFacade;

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

Route::prefix('admin')
->middleware('auth','can:admin')
->group(function () {
    //*Mostrar el calendario en admin
    Route::get('/', [SolicitudController::class, 'index'])->name('admin.home');
    //*Lista de solicitudes en admin
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('admin.listar.solicitudes');
    //*Pagina de creacion de solicitud en admin
    Route::get('/solicitud', [SolicitudController::class, 'docente_datos'])->name('admin.solicitud.registrar');
    //*Creacion de una en back solicitud
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    /**
     * Rutas de los ambientes
     */
    //*Muestra todos los ambientes
    Route::get('/ambientes', [AmbienteController::class, 'index'])->name('admin.ambientes.list');
    //*Muestra el formulario para los ambientes
    Route::get('/ambientes/registro', [AmbienteController::class, 'store'])->name('admin.ambiente.registrar');
    //*Guarda o registra un registro de un nuevo ambiente
    Route::post('/ambientes/store', [AmbienteController::class, 'store'])->name('ambiente.store');
    //*
    Route::put('/ambientes/show/{nombre}', [AmbienteController::class, 'show'])->name('ambiente.put');

    /** 
     * Urls para horarios
    */
    //*Muestra todos los horarios
    Route::get('/horarios', [HorarioController::class, 'index'])->name('admin.horarios.list');
    //*Muestra el formulario de horarios
    Route::get('/horarios/registro', [HorarioController::class, 'store'])->name('admin.horario.registrar');
    //*Crea un registro nuevo en el servidor de los horarios
    Route::post('/horarios/store', [HorarioController::class, 'store'])->name('horario.store');
    //*Muestra los horarios para modificarlos
    Route::get('/horarios/update', [HorarioController::class, 'indexMod'])->name('admin.horarios.modificar');

    Route::get('/notificacion', [NotificacionController::class, 'index'])->name('see.notificaciones');
    Route::post('/notificacion/store', [NotificacionController::class, 'store'])->name('send.notificaciones');
    //*Mostrar las solicitudes pendientes
    Route::get('/reservas/atencion', [ReservasController::class, 'index'])->name('admin.reservas.atender');
    //*Cambiar el estado de la solicitud al ser atendida
    Route::put('/reservas/store', [ReservasController::class, 'store'])->name('reserva.store');
    //*Mostrar reservas para cancelar
    Route::get('/reservas/cancelar', [ReservasController::class, 'indexCancelar'])->name('admin.reservas.cancelar');
    //*Cancelar una reserva
    Route::put('/reservas/update', [ReservasController::class, 'update'])->name('reservas.name');

    //Listar
    //Route::get('/listar', [ListarController::class, 'datos'])->name('admin.listar.solicitudes');
    Route::get('/listar/{id}', [ListarController::class, 'show'])->name('admin.reservas.show');
    Route::get('/solicitudes/listar_filtro', [ListarController::class, 'datos_filtro'])->name('admin.solicitud.filtrar.datos_filtro');
    //Reportes
    Route::get('/reportes', [ReportesController::class, 'datos'])->name('admin.reportes');
    Route::get('/reportes/listar_filtro', [ReportesController::class, 'datos_filtro'])->name('admin.reportes.filtrar.datos_filtro');
    Route::get('/reportes/pdf', [ReportesController::class, 'exportarPDF'])->name('admin.exportarPDF');

    Route::get('/mapa', [MapaControler::class, 'index'])->name('mapa.index');
});

// Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
Route::prefix('docente')
//!!Autorizacion de docente se descomenta para tener la autorizacion
//->middleware('auth','can:docente')
->group(function () {
    Route::get('/', [CalendarioController::class, 'index'])->name('docente.inicio');
    Route::get('/solicitud/normal/hola', [SolicitudController::class, 'fecha'])->name('docente.solicitud.fecha');
    Route::get('/solicitud/normal/', [SolicitudController::class, 'docente_datos'])->name('docente.solicitud.normal');
    Route::get('/solicitud/urgente', [SolicitudController::class, 'urgente'])->name('docente.solicitud.urgente');

    //Route::get('/solicitudes/urgencia', [ReservasController::class, 'filtrar_modo'])->name('docente.solicitud.filtrar.urgente');
    Route::get('/solicitudes/listar', [ReservasController::class, 'datos'])->name('docente.solicitud.filtrar.datos'); //si da
    /**
     * Se debe unir todas estas en una sola url y mandar por get
     */
    Route::get('/solicitudes/listar/cancelar', [ReservasController::class, 'datos_cancelar'])->name('docente.solicitud.filtrar.datos_cancelar'); //si da
    Route::get('/solicitudes/listar/pendiente', [ReservasController::class, 'datos_solicitando'])->name('docente.solicitud.filtrar.datos_solicitando'); //si da
    Route::get('/solicitudes/listar/reservado', [ReservasController::class, 'datos_reservado'])->name('docente.solicitud.filtrar.datos_reservado'); //si da 
    
    Route::get('/solicitudes/listar_filtro', [ReservasController::class, 'datos_filtro'])->name('docente.solicitud.filtrar.datos_filtro');
    
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    //Route::get('/reservas', [ReservasController::class, 'index'])->name('docente.reservas');
    //Route::get('/reservas/{id}', [ReservasController::class, 'show'])->name('docente.reservas.show');
    Route::get('/solicitudes/cancelar', [ReservasController::class, 'cancelar_solicitud'])->name('docente.solicitud.cancelar');
    Route::put('/solicitudes/{solicitud}/cancelar', [ReservasController::class, 'cancelar'])->name('docente.reservas.cancelar');

    //Hu registro reservas
    Route::get('/registroReservas', [ReservasController::class, 'registroReservas'])->name('docente.registroReservas');
    Route::get('/registroRazonDenoAsignacion', [ReservasController::class, 'registroRazonDenoAsignacion'])->name('docente.registroRazonDenoAsignacion');
    Route::get('/registroRazonDenoAsignacion/{id}', [ReservasController::class, 'showReservas'])->name('docente.reservas.showReservas');
        
    Route::get('/mapa', [MapaControler::class, 'index'])->name('mapa.index');
});


