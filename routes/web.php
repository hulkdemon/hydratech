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


//Grupo de rutas prefijas con admin para el controlador de UMA

Route::prefix('admin/uma')->group(function () {
    // Ruta para mostrar el formulario de registro de UMA
    Route::get('registrar_uma', [UmaControlador::class, 'create'])->name('admin.uma.registrar_uma');
    
    // Ruta para mostrar los detalles de un rol específico
    Route::get('{id_uma}', [UmaControlador::class, 'show'])->name('admin.uma.show');

    // Ruta para mostrar todos los registros de UMA
    Route::get('ver_uma', [UmaControlador::class, 'show'])->name('admin.uma.ver_uma');

    // Ruta para almacenar los datos del formulario de creación de roles
    Route::post('', [UmaControlador::class, 'store'])->name('admin.uma.store');

    /* Ruta para mostrar el formulario de edición de un rol
    Route::get('{id_uma}/editar_roles', [UmaControlador::class, 'edit'])->name('admin.uma.edit');

    // Ruta para actualizar los datos de UMA
    Route::put('{id_uma}', [UmaControlador::class, 'update'])->name('admin.uma.update');

    // Ruta para eliminar un UMA
    Route::delete('{id_uma}', [UmaControlador::class, 'destroy'])->name('admin.uma.destroy');
    **/
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

    // Ruta para mostrar el formulario de edición de contrato
    Route::get('{id_contrato}/editar_contrato', [ContratosControlador::class, 'edit'])->name('caja.contratos.edit');

    // Ruta para actualizar los datos de un contrato
    Route::put('{id_contrato}', [ContratosControlador::class, 'update'])->name('caja.contratos.update');

});


//Grupo de rutas prefijas con caja para el controlador de Datos Fiscales

Route::prefix('caja/datos_fiscales')->group(function () {
    // Ruta para mostrar el formulario de creación de datos fiscales
    Route::get('registrar_datos_fiscales', [DatosFiscalesControlador::class, 'create'])->name('caja.datos_fiscales.registrar_datos_fiscales');
    
    // Ruta para mostrar los detalles de datos fiscales específicos
    Route::get('{id_datos_fiscales}', [DatosFiscalesControlador::class, 'show'])->name('caja.datos_fiscales.show');

    // Ruta para mostrar todos los datos fiscales
    Route::get('ver_datos_fiscales', [DatosFiscalesControlador::class, 'show'])->name('caja.datos_fiscales.ver_datos_fiscales');

    // Ruta para almacenar los datos del formulario de creación de datos fiscales
    Route::post('', [DatosFiscalesControlador::class, 'store'])->name('caja.datos_fiscales.store');

    // Ruta para mostrar el formulario de edición de datos fiscales
    Route::get('{id_datos_fiscales}/editar_datos_fiscales', [DatosFiscalesControlador::class, 'edit'])->name('caja.datos_fiscales.edit');

    // Ruta para actualizar los datos fiscales
    Route::put('{id_datos_fiscales}', [DatosFiscalesControlador::class, 'update'])->name('caja.datos_fiscales.update');

});


//Grupo de rutas prefijas con caja para el controladro de condonaciones en caja
Route::prefix('caja/condonaciones')->group(function () {
    // Ruta para mostrar el formulario de creación de usuarios
    Route::get('solicitar_condonaciones', [CondonacionesControlador::class, 'create'])->name('caja.condonaciones.solicitar_condonaciones');
    
});

Route::prefix('caja/cobro')->group(function () {
    // Ruta para mostrar el formulario de creación de datos fiscales
    Route::get('recibo', [CobrosConceptoControlador::class, 'create'])->name('caja.cobros.recibo');
});

