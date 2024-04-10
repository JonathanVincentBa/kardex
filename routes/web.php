<?php

use App\Http\Controllers\ClienteExportController;
use App\Http\Controllers\ControlExportController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\CartasReportsController;
use App\Http\Livewire\ClienteReportsController;
use App\Http\Livewire\ClientesController;
use App\Http\Livewire\ContactoClientesController;
use App\Http\Livewire\ControlArchivosController;
use App\Http\Livewire\ControlArchivosReportsController;
use App\Http\Livewire\CorrespondenciaReportsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/clientes', ClientesController::class)->name('clientes')->middleware('auth');

Route::get('/contacto-clientes',ContactoClientesController::class)->middleware('auth')->name('contacto-clientes');

Route::get('/servicios', ServiciosController::class)->middleware('auth')->name('servicios');

Route::get('/tipo-servicios', TipoServiciosController::class)->middleware('auth')->name('tipo-servicios');

Route::get('/control-archivos', ControlArchivosController::class)->middleware('auth')->name('control-archivos');

Route::get('/control-archivos-reports', ControlArchivosReportsController::class)->middleware('auth')->name('control-archivos-reports');

Route::get('/ingreso-documentos', IngresoDocumentosController::class)->middleware('auth')->name('ingreso-documentos');

Route::get('/kardex', KardexController::class)->name('kardex')->middleware('auth');

Route::get('/roles', RolesController::class)->name('roles')->middleware('auth');

Route::get('/permisos', PermisosController::class)->middleware('auth')->name('permisos');

Route::get('/asignar', AsignarController::class)->middleware('auth')->name('asignar');

Route::get('/users', UsersController::class)->middleware('auth')->name('users');

Route::get('/cliente-reports', ClienteReportsController::class)->middleware('auth')->name('cliente-reports');

Route::get('/correspondencia-reports', CorrespondenciaReportsController::class)->middleware('auth')->name('cliente-reports');

Route::get('/cartas-reports', CartasReportsController::class)->middleware('auth')->name('cartas-reports');

Route::get('control-report/pdf/{cliente}/{type}/{carpeta}', [ControlExportController::class, 'reportPDF']);

Route::get('cliente-report/pdf/{type}', [ClienteExportController::class, 'reportPDF']);