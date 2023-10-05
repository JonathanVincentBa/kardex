<?php

use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ClientesController;
use App\Http\Livewire\ContactoClientesController;
use App\Http\Livewire\ControlArchivosController;
use App\Http\Livewire\IngresoDocumentosController;
use App\Http\Livewire\Kardexcontroller;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\Roles;
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

Route::get('/clientes', ClientesController::class);

Route::get('/contacto-clientes',ContactoClientesController::class);

Route::get('/servicios', ServiciosController::class);


Route::get('/tipo-servicios', TipoServiciosController::class);

Route::get('/control-archivos', ControlArchivosController::class);

Route::get('/ingreso-documentos', IngresoDocumentosController::class);

Route::get('/kardex', KardexController::class);

Route::get('/roles', RolesController::class);

Route::get('/permisos', PermisosController::class);

Route::get('/asignar', AsignarController::class);

Route::get('/user', UsersController::class);


