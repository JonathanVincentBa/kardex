<?php

use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ClientesController;
use App\Http\Livewire\ContactoClientesController;
use App\Http\Livewire\ControlArchivosController;
use App\Http\Livewire\ControlReportController;
use App\Http\Livewire\IngresoDocumentosController;
use App\Http\Livewire\Kardexcontroller;
use App\Http\Livewire\PassivesController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\ServiciosController;
use App\Http\Livewire\TipoServiciosController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/clientes', ClientesController::class)->name('clientes');

Route::get('/contacto-clientes',ContactoClientesController::class)->name('contacto-clientes');

Route::get('/servicios', ServiciosController::class)->name('servicios');

Route::get('/tipo-servicios', TipoServiciosController::class)->name('tipo-servicios');

Route::get('/control-archivos', ControlArchivosController::class)->name('control-archivos');

Route::get('/ingreso-documentos', IngresoDocumentosController::class)->name('ingreso-documentos');

Route::get('/kardex', KardexController::class)->name('kardex');

Route::get('/roles', RolesController::class)->name('roles');

Route::get('/permisos', PermisosController::class)->name('permisos');

Route::get('/asignar', AsignarController::class)->name('asignar');

Route::get('/users', UsersController::class)->name('users');

Route::get('/control-report', ControlReportController::class)->name('control-report');

Route::get('/pasivo', PassivesController::class)->name('pasivo');



