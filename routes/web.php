<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Docente\SolicitudController;
use App\Http\Controllers\Docente\ReservasController;
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

    Route::get('/hola',  function () {
        return 'Hola :v';
    });
});
// Route::get('/solicitud', [SolicitudController::class, 'index'])->name('solicitud.index');
Route::prefix('docente')->group(function () {
    Route::get('/', [SolicitudController::class, 'index'])->name('docente.home');
    Route::get('/reservas/urgencia', [ReservasController::class, 'filtrar_modo'])->name('docente.reservas.filtrar.modo');
    Route::get('/reservas/llegada', [ReservasController::class, 'filtrar_llegada'])->name('docente.reservas.filtrar.llegada');
    Route::post('/solicitud/create', [SolicitudController::class, 'store'])->name('solicitud.store');
    Route::get('/reservas', [ReservasController::class, 'index'])->name('docente.reservas');
    Route::get('/reservas/{id}', [ReservasController::class, 'show'])->name('docente.reservas.show');
    Route::put('/solicitudes/{solicitud}/cancelar', [ReservasController::class, 'cancelar'])->name('docente.reservas.cancelar');
});
