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
Route::prefix('admin/roles')->middleware('auth')->group(function () {
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
Route::prefix('admin/uma')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de registro de UMA
    Route::get('registrar_uma', [UmaControlador::class, 'create'])->name('admin.uma.registrar_uma');
    
    // Ruta para mostrar los detalles de un UMA específico
    Route::get('{id_uma}', [UmaControlador::class, 'show'])->name('admin.uma.show');

    // Ruta para mostrar todos los registros de UMA
    Route::get('ver_uma', [UmaControlador::class, 'show'])->name('admin.uma.ver_uma');

    // Ruta para almacenar los datos del formulario de creación de UMA
    Route::post('', [UmaControlador::class, 'store'])->name('admin.uma.store');

});


//Grupo de rutas prefijas con admin para el controlador de Usuario
Route::prefix('admin/usuarios')->middleware('auth')->group(function () {
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

    // Ruta para mostrar la vista de la gestión de contratos para asignar condonaciones
    Route::get('gestion_contratos', [CondonacionesControlador::class, 'gestion_contratos'])->name('admin.condonaciones.gestion_contratos');

    // Ruta para mostrar el formulario de creación de condonaciones
    Route::get('asignar_condonaciones', [CondonacionesControlador::class, 'asignar_condonaciones'])->name('admin.condonaciones.asignar_condonaciones');

    // Ruta para almacenar los datos del formulario de creación de condonaciones
    Route::post('registrar_condonacion', [CondonacionesControlador::class, 'registrar_condonacion'])->name('admin.condonaciones.registrar_condonacion');

});


//--------------------------------------------RUTAS PARA CAJA----------------------------------------------


//Grupo de rutas prefijas con caja para el controlador de tipos de contrato
Route::prefix('caja/tipos_contrato')->middleware('auth')->group(function () {

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

Route::prefix('caja/contratos')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de creación de contratos
    Route::get('registrar_contrato', [ContratosControlador::class, 'create'])->name('caja.contratos.registrar_contrato');
    
    // Ruta para mostrar los detalles de un contrato específico
    Route::get('{id_contrato}', [ContratosControlador::class, 'show'])->name('caja.contratos.show');

    // Ruta para mostrar todos los contratos
    Route::get('ver_contratos', [ContratosControlador::class, 'show'])->name('caja.contratos.ver_contratos');

    // Ruta para almacenar los datos del formulario de creación de contratos
    Route::post('', [ContratosControlador::class, 'store'])->name('caja.contratos.store');

    // Ruta para mostrar el formulario de edición de un contrato
    Route::get('{id_contrato}/editar_contrato', [ContratosControlador::class, 'edit'])->name('caja.contratos.edit');

    // Ruta para actualizar los datos de un contrato
    Route::put('{id_contrato}', [ContratosControlador::class, 'update'])->name('caja.contratos.update');

});

//Grupo de rutas prefijas con caja para el controlador de cobros
Route::prefix('caja/cobros')->middleware('auth')->group(function () {

    // Ruta para mostrar el formulario de búsqueda para asignar cobros
    Route::get('gestion_contratos', [CobrosControlador::class, 'index'])->name('caja.cobros.gestion_contratos');

    // Ruta para mostrar el formulario de creación de cobros
    Route::get('registrar_cobro/{id_contrato}', [CobrosControlador::class, 'create'])->name('caja.cobros.registrar_cobro');
    
    // Ruta para mostrar los detalles de un cobro específico
    Route::get('{id_cobro}', [CobrosControlador::class, 'show'])->name('caja.cobros.show');

    // Ruta para mostrar todos los cobros
    Route::get('{id_contrato}/ver_cobros', [CobrosControlador::class, 'show'])->name('caja.cobros.show');

    // Ruta para almacenar los datos del formulario de creación de cobros
    Route::post('', [CobrosControlador::class, 'store'])->name('caja.cobros.store');

    Route::get('{id_cobro}/recibo', [CobrosControlador::class, 'recibo'])->name('caja.cobros.recibo');


});


//Grupo de rutas prefijas con caja para el controlador de Datos Fiscales

Route::prefix('caja/datos_fiscales')->middleware('auth')->group(function () {
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

//Grupo de rutas prefijas con caja para el controlador de Conceptos

Route::prefix('caja/conceptos')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de creación de datos fiscales
    Route::get('registrar_concepto', [ConceptosControlador::class, 'create'])->name('caja.conceptos.registrar_concepto');
    
    // Ruta para mostrar los detalles de datos fiscales específicos
    Route::get('{id_concepto}', [ConceptosControlador::class, 'show'])->name('caja.conceptos.show');

    // Ruta para mostrar todos los datos fiscales
    Route::get('ver_conceptos', [ConceptosControlador::class, 'show'])->name('caja.conceptos.ver_conceptos');

    // Ruta para almacenar los datos del formulario de creación de datos fiscales
    Route::post('', [ConceptosControlador::class, 'store'])->name('caja.conceptos.store');

});

//Grupo de rutas prefijas de caja para el controlador de Asignar Conceptos
Route::prefix('caja/cobros_conceptos')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de creación de datos fiscales
    Route::get('asignar_conceptos', [CobrosConceptoControlador::class, 'create'])->name('caja.cobros_conceptos.asignar_conceptos');
    
    // Ruta para mostrar los detalles de datos fiscales específicos
    Route::get('{id_cobro_concepto}', [CobrosConceptoControlador::class, 'show'])->name('caja.cobros_conceptos.show');

    // Ruta para mostrar todos los datos fiscales
    Route::get('ver_cobros_concepto', [CobrosConceptoControlador::class, 'show'])->name('caja.cobros_conceptos.ver_cobros_concepto');

    // Ruta para almacenar los datos del formulario de creación de datos fiscales
    Route::post('', [CobrosConceptoControlador::class, 'store'])->name('caja.cobros_conceptos.store');

});

//Grupo de rutas prefijas con caja para el controlador de Creditos

Route::prefix('caja/creditos')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de creación de datos fiscales
    Route::get('registrar_creditos', [CreditosControlador::class, 'create'])->name('caja.creditos.registrar_creditos');
    
    // Ruta para mostrar los detalles de datos fiscales específicos
    Route::get('{id_credito}', [CreditosControlador::class, 'show'])->name('caja.creditos.show');

    // Ruta para mostrar todos los datos fiscales
    Route::get('ver_creditos', [CreditosControlador::class, 'show'])->name('caja.creditos.ver_creditos');

    // Ruta para almacenar los datos del formulario de creación de datos fiscales
    Route::post('', [CreditosControlador::class, 'store'])->name('caja.creditos.store');

});
    

//Grupo de rutas prefijas con caja para el controlador de Cobros Concepto

Route::prefix('caja/creditos')->middleware('auth')->group(function () {
    // Ruta para mostrar el formulario de registro de créditos
    Route::get('registrar_creditos', [CreditosControlador::class, 'create'])->name('caja.creditos.registrar_creditos');
    
    // Ruta para mostrar los detalles de créditos específicos
    Route::get('{id_credito}', [CreditosControlador::class, 'show'])->name('caja.creditos.show');

    // Ruta para mostrar todos los créditos
    Route::get('ver_creditos', [CreditosControlador::class, 'show'])->name('caja.creditos.ver_creditos');

    // Ruta para almacenar los datos del formulario de creación de créditos
    Route::post('', [CreditosControlador::class, 'store'])->name('caja.creditos.store');

});
    
//Grupo de rutas prefijas con caja para el controlador de condonaciones en caja
Route::prefix('caja/condonaciones')->middleware('auth')->group(function () {

    // Ruta para mostrar el formulario de solicitar condonaciones
    Route::get('solicitar_condonaciones', [CondonacionesControlador::class, 'solicitar_condonaciones'])->name('caja.condonaciones.solicitar_condonaciones');

    // Ruta para almacenar los datos del formulario de solicitar condonaciones
    Route::post('guardar_condonacion_solicitada', [CondonacionesControlador::class, 'guardar_condonacion_solicitada'])->name('caja.condonaciones.guardar_condonacion_solicitada');

    // Ruta para mostrar los detalles de condonaciones específicas
    Route::get('{id_condonacion}', [CondonacionesControlador::class, 'show'])->name('caja.condonaciones.show');

    // Ruta para mostrar todos los datos de condonaciones
    Route::get('ver_condonaciones', [CondonacionesControlador::class, 'show'])->name('caja.condonaciones.ver_condonaciones');

    //Ruta para aprobar la condonación del contrato
    Route::get('{id_condonacion}/aceptar_condonacion', [CondonacionesControlador::class, 'aceptar_condonacion'])->name('caja.condonaciones.aceptar_condonacion');

    //Ruta para rechazar la condonación del contrato
    Route::get('{id_condonacion}/rechazar_condonacion', [CondonacionesControlador::class, 'rechazar_condonacion'])->name('caja.condonaciones.rechazar_condonacion');
});

