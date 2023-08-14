<?php

use App\Http\Controllers\CobrosConceptoControlador;
use App\Http\Controllers\CobrosControlador;
use App\Http\Controllers\ConceptosControlador;
use App\Http\Controllers\CondonacionesControlador;
use App\Http\Controllers\ContratosControlador;
use App\Http\Controllers\CreditosControlador;
use App\Http\Controllers\DatosFiscalesControlador;
use App\Http\Controllers\FacturasControlador;
use App\Http\Controllers\RolControlador;
use App\Http\Controllers\TiposContratoControlador;
use App\Http\Controllers\UmaControlador;
use App\Http\Controllers\UsuarioControlador;
use App\Models\DatosFiscalesModelo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//--------------------------------------------RUTAS PARA ADMINISTRADOR----------------------------------------------

//Grupo de rutas prefijas con admin para el controlador de Rol
Route::prefix('admin/roles')->group(function () {
    // Ruta para mostrar el formulario de creación de roles
    Route::get('registrar_rol', [RolControlador::class, 'create'])->name('admin.roles.registrar_rol');
    
    // Ruta para mostrar los detalles de un rol específico
    Route::get('{id_rol}', [RolControlador::class, 'show'])->name('admin.roles.show');

    // Ruta para mostrar todos los roles
    Route::get('ver_roles', [RolControlador::class, 'show'])->name('admin.roles.ver_roles');

    // Ruta para almacenar los datos del formulario de creación de roles
    Route::post('', [RolControlador::class, 'store'])->name('admin.roles.store');

    // Ruta para mostrar el formulario de edición de un rol
    Route::get('{id_rol}/editar_roles', [RolControlador::class, 'edit'])->name('admin.roles.edit');

    // Ruta para actualizar los datos de un rol
    Route::put('{id_rol}', [RolControlador::class, 'update'])->name('admin.roles.update');

    // Ruta para eliminar un rol
    Route::delete('{id_rol}', [RolControlador::class, 'destroy'])->name('admin.roles.destroy');
});


//Grupo de rutas prefijas con admin para el controlador de Usuario
Route::prefix('admin/usuarios')->group(function () {
    // Ruta para mostrar el formulario de creación de usuarios
    Route::get('registrar_usuario', [UsuarioControlador::class, 'create'])->name('admin.usuarios.registrar_usuario');
    
    // Ruta para mostrar los detalles de un usuario específico
    Route::get('{id_usuario}', [UsuarioControlador::class, 'show'])->name('admin.usuarios.show');

    // Ruta para mostrar todos los usuarios
    Route::get('ver_usuarios', [UsuarioControlador::class, 'show'])->name('admin.usuarios.ver_usuarios');

    // Ruta para almacenar los datos del formulario de creación de usuarios
    Route::post('', [UsuarioControlador::class, 'store'])->name('admin.usuarios.store');

    // Ruta para mostrar el formulario de edición de un usuario
    Route::get('{id_usuario}/editar_usuario', [UsuarioControlador::class, 'edit'])->name('admin.usuarios.edit');

    // Ruta para actualizar los datos de un usuario
    Route::put('{id_usuario}', [UsuarioControlador::class, 'update'])->name('admin.usuarios.update');

    // Ruta para eliminar un usuario
    Route::delete('{id_usuario}', [UsuarioControlador::class, 'destroy'])->name('admin.usuarios.destroy');
});


//Grupo de rutas prefijas con admin para el controlador de Usuario
Route::prefix('admin/condonaciones')->group(function () {
    
    // Ruta para mostrar la vista de la gestión de condonaciones
    Route::get('gestion_condonaciones', [CondonacionesControlador::class, 'show'])->name('admin.condonaciones.gestion_condonaciones');

});


//--------------------------------------------RUTAS PARA CAJA----------------------------------------------


//Grupo de rutas prefijas con caja para el controlador de tipos de contrato
Route::prefix('caja/tipos_contrato')->group(function () {

    // Ruta para mostrar el formulario de creación de tipos de contrato
    Route::get('registrar_tipo_contrato', [TiposContratoControlador::class, 'create'])->name('caja.tipos_contrato.registrar_tipo_contrato');
    
    // Ruta para mostrar los detalles de un tipo de contrato específico
    Route::get('{id_tipo_contrato}', [TiposContratoControlador::class, 'show'])->name('caja.tipos_contrato.show');

    // Ruta para mostrar todos los tipos de contrato
    Route::get('ver_tipos_contrato', [TiposContratoControlador::class, 'show'])->name('caja.tipos_contrato.ver_tipos_contrato');

    // Ruta para almacenar los datos del formulario de creación de tipos de contrato
    Route::post('', [TiposContratoControlador::class, 'store'])->name('caja.tipos_contrato.store');

    // Ruta para mostrar el formulario de edición de un tipo de contrato
    Route::get('{id_tipo_contrato}/editar_tipos_contrato', [TiposContratoControlador::class, 'edit'])->name('caja.tipos_contrato.edit');

    // Ruta para actualizar los datos de un tipo de contrato
    Route::put('{id_tipo_contrato}', [TiposContratoControlador::class, 'update'])->name('caja.tipos_contrato.update');

    // Ruta para eliminar un tipo de contrato
    Route::delete('{id_tipo_contrato}', [TiposContratoControlador::class, 'destroy'])->name('caja.tipos_contrato.destroy');
});



//Grupo de rutas prefijas con caja para el controlador de Contratos

Route::prefix('caja/contratos')->group(function () {
    // Ruta para mostrar el formulario de creación de contratos
    Route::get('registrar_contrato', [ContratosControlador::class, 'create'])->name('caja.contratos.registrar_contrato');
    
    // Ruta para mostrar los detalles de un contrato específico
    Route::get('{id_contrato}', [ContratosControlador::class, 'show'])->name('caja.contratos.show');

    // Ruta para mostrar todos los contratos
    Route::get('ver_contratos', [ContratosControlador::class, 'show'])->name('caja.contratos.ver_contratos');

    // Ruta para almacenar los datos del formulario de creación de contratos
    Route::post('', [ContratosControlador::class, 'store'])->name('caja.contratos.store');

});

//Grupo de rutas prefijas con caja para el controlador de cobros
Route::prefix('caja/cobros')->group(function () {

    // Ruta para mostrar el formulario de búsqueda para asignar cobros
    Route::get('busqueda_cobros', [CobrosControlador::class, 'index'])->name('caja.cobros.busqueda_cobros');

    // Ruta para mostrar el formulario de creación de cobros
    Route::get('registrar_cobro', [CobrosControlador::class, 'create'])->name('caja.cobros.registrar_cobro');
    
    // Ruta para mostrar los detalles de un cobro específico
    Route::get('{id_cobro}', [CobrosControlador::class, 'show'])->name('caja.cobros.show');

    // Ruta para mostrar todos los cobros
    Route::get('ver_cobros', [CobrosControlador::class, 'show'])->name('caja.cobros.ver_cobros');

    // Ruta para almacenar los datos del formulario de creación de cobros
    Route::post('', [CobrosControlador::class, 'store'])->name('caja.cobros.store');
    
});


//Grupo de rutas prefijas con caja para el controladro de condonaciones en caja
Route::prefix('caja/condonaciones')->group(function () {
    // Ruta para mostrar el formulario de creación de usuarios
    Route::get('solicitar_condonaciones', [CondonacionesControlador::class, 'create'])->name('caja.condonaciones.solicitar_condonaciones');
    
});

