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
    //?Mostrar el calendario en admin
    Route::get('/', [CalendarioController::class, 'index'])->name('admin.inicio');
    //?Lista de solicitudes en admin
    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('admin.listar.solicitudes');
    //?Pagina de creacion de solicitud en admin
    Route::get('/solicitud', [SolicitudController::class, 'docente_datos'])->name('admin.solicitud.registrar');
    //?Creacion de una en back solicitud
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    //?Muestra todos los ambientes
    Route::get('/ambientes', [AmbienteController::class, 'index'])->name('admin.ambientes.list');
    //?Muestra el formulario para los ambientes
    Route::get('/ambientes/registro', [AmbienteController::class, 'store'])->name('admin.ambiente.registrar');
    //?Guarda o registra un registro de un nuevo ambiente
    Route::post('/ambientes/store', [AmbienteController::class, 'store'])->name('ambiente.store');
    //?
    Route::put('/ambientes/show/{nombre}', [AmbienteController::class, 'show'])->name('ambiente.put');
    //?Muestra todos los horarios
    Route::get('/horarios', [HorarioController::class, 'index'])->name('admin.horarios.list');
    //?Muestra el formulario de horarios
    Route::get('/horarios/registro', [HorarioController::class, 'store'])->name('admin.horario.registrar');
    //?Crea un registro nuevo en el servidor de los horarios
    Route::post('/horarios/store', [HorarioController::class, 'store'])->name('horario.store');
    //?Muestra los horarios para modificarlos
    Route::get('/horarios/update', [HorarioController::class, 'indexMod'])->name('admin.horarios.modificar');

    //?Mostrar notificaciones y mensajes
    Route::get('/mailbox', [NotificacionController::class, 'index'])->name('admin.notificaciones.list');
    //?Guardar notificaciones
    Route::post('/notificacion/store', [NotificacionController::class, 'store'])->name('send.notificaciones');
    
    //?Mostrar las solicitudes pendientes
    Route::get('/reservas/atencion', [ReservasController::class, 'index'])->name('admin.reservas.atender');
    //?Cambiar el estado de la solicitud al ser atendida
    Route::put('/reservas/store', [ReservasController::class, 'store'])->name('reserva.store');
    //?Mostrar reservas para cancelar
    Route::get('/reservas/cancelar', [ReservasController::class, 'indexCancelar'])->name('admin.reservas.cancelar');
    //?Cancelar una reserva
    Route::put('/reservas/update', [ReservasController::class, 'update'])->name('reservas.name');

    //Listar
    //Route::get('/listar', [ListarController::class, 'datos'])->name('admin.listar.solicitudes');
    Route::get('/listar/{id}', [ListarController::class, 'show'])->name('admin.reservas.show');
    Route::get('/solicitudes/listar_filtro', [ListarController::class, 'datos_filtro'])->name('admin.solicitud.filtrar.datos_filtro');
    //Reportes
    Route::get('/reportes', [ReportesController::class, 'datos'])->name('admin.reportes');
    Route::get('/reportes/listar_filtro', [ReportesController::class, 'datos_filtro'])->name('admin.reportes.filtrar.datos_filtro');
    Route::get('/reportes/pdf', [ReportesController::class, 'exportarPDF'])->name('admin.exportarPDF');

    Route::get('/mapa', [MapaControler::class, 'index'])->name('admin.mapa.facultad');
});

// Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
Route::prefix('docente')
->middleware('auth','can:docente')
->group(function () {
    Route::get('/', [CalendarioController::class, 'index'])->name('docente.inicio');
    Route::get('/solicitud/normal/', [SolicitudController::class, 'docente_datos'])->name('docente.solicitud.normal');

    //Route::get('/solicitudes/urgencia', [ReservasController::class, 'filtrar_modo'])->name('docente.solicitud.filtrar.urgente');
    Route::get('/solicitudes/listar', [SolicitudController::class, 'index'])->name('docente.solicitud.listar'); //si da
    
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::post('/notificacion/store', [NotificacionController::class, 'store'])->name('send.notificaciones');

    Route::get('/solicitudes/cancelar', [ReservasController::class, 'index'])->name('docente.solicitud.cancelar');
    Route::put('/solicitud/cancelar', [ReservasController::class, 'store'])->name('docente.reservas.cancelar');

    //Hu registro reservas
    Route::get('/reservas', [ReservasController::class, 'indexCancelar'])->name('docente.reservas.listar');
        
    Route::get('/mapa', [MapaControler::class, 'index'])->name('mapa.index');
});


