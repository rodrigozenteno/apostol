<?php

use App\Http\Controllers\AlergiaController;
use App\Http\Controllers\ArmaController;
use App\Http\Controllers\Datocomplementario_UserController;
use App\Http\Controllers\DatofamiliarController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DiplomadoController;
use App\Http\Controllers\Documento_UserController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EscalafonController;
use App\Http\Controllers\SeguroController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Pistola_UserController;
use App\Http\Controllers\Armamento_UserController;
use App\Http\Controllers\Destino_NovedadController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\IndustriaController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfocupController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RelacionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SituacionController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariosController;
use App\Http\Controllers\MatbelController;
use App\Http\Controllers\Tipo_armamentoController;
use App\Models\Datofamiliar;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
}); */

/* Route::get('/inicio', function () {
    return view('auth.login');
})->name('inicio'); */

//Route::resource('alergias', AlergiaController::class)->names('alergias')->middleware(['auth:sanctum']);
Route::resource('alergias', AlergiaController::class)->names('alergias');
Route::resource('seguros', SeguroController::class)->names('seguros');
Route::resource('estados', EstadoController::class)->names('estados');
Route::resource('especialidads', EspecialidadController::class)->names('especialidads');
Route::resource('diplomados', DiplomadoController::class)->names('diplomados');
Route::resource('escalafons', EscalafonController::class)->names('escalafons');
Route::resource('armas', ArmaController::class)->names('armas');
Route::resource('grados', GradoController::class)->names('grados');
Route::resource('departamentos', DepartamentoController::class)->names('departamentos');
Route::resource('provincias', ProvinciaController::class)->names('provincias');
Route::resource('municipios', MunicipioController::class)->names('municipios');
Route::resource('profocups', ProfocupController::class)->names('profocups');
//Route::controller(UserController::class)->middleware(['auth:sanctum])->group(function () {
Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index');
    Route::get('users/index_ant', 'index_ant')->name('users.index_ant');
    Route::get('users/index_servicios', 'index_servicios')->name('users.index_servicios');
    Route::get('users/index_eecc', 'index_eecc')->name('users.index_eecc');
    Route::get('users/{user}/create', 'create')->name('users.create');
    Route::get('users/{user}', 'show')->name('users.show');
    Route::delete('users/{user}', 'destroy')->name('users.destroy');
    Route::get('users/{user}/edit', 'edit')->name('users.edit');
    Route::post('users/store', 'store')->name('users.store');
    Route::post('users/store_eecc', 'store_eecc')->name('users.store_eecc');
    Route::get('users/{user}', 'asignar_roles')->name('users.asignar_roles');
    Route::post('users/store_roles', 'store_roles')->name('users.store_roles');
    Route::get('users/{user}/edit_roles', 'edit_roles')->name('users.edit_roles');
    Route::put('users/{user}', 'update')->name('users.update');
    Route::put('users/{user}/update', 'update_roles')->name('users.update_roles');
    Route::put('users/{user}', 'update')->name('users.update');
});
Route::controller(Datocomplementario_UserController::class)->group(function () {
    Route::get('datos/{dato}/datos_complementarios', 'datos_complementarios')->name('datos.datos_complementarios');
    Route::get('datos/{dato}/create', 'create')->name('datos.create');
    Route::get('datos/{dato}/edit', 'edit')->name('datos.edit');
    Route::post('datos/store', 'store')->name('datos.store');
    Route::put('datos/{dato}', 'update')->name('datos.update');
    Route::get('datos/{dato}/eliminar', 'eliminar')->name('datos.eliminar');
});
Route::controller(Documento_UserController::class)->group(function () {
    Route::get('documentos_users/{user}/index', 'index')->name('documentos_users.index');
    Route::get('documentos_users/{user}/{documento}/create', 'create')->name('documentos_users.create');
    Route::post('documentos_users/store', 'store')->name('documentos_users.store');
    Route::get('documentos_users/{user}/{documento}/validar', 'validar')->name('documentos_users.validar');
    Route::get('documentos_users/{user}/{documento}/show', 'show')->name('documentos_users.show');
    Route::get('documentos_users/{user}/{documento}/edit', 'edit')->name('documentos_users.edit');
    Route::put('documentos_users/{documento_user}', 'update')->name('documentos_users.update');
    Route::get('documentos_users/{documento}/delete', 'delete')->name('documentos_users.delete'); 
});
Route::resource('documentos', DocumentoController::class)->names('documentos');
Route::get('pdfs/{pdf}/pdf_user', [PdfController::class, 'pdf_user'])->name('pdfs.pdf_user');
Route::resource('pdfs', PdfController::class)->names('pdfs');
Route::resource('relacions', RelacionController::class)->names('relacions');
Route::controller(DatofamiliarController::class)->group(function () {
    Route::get('datofamiliars/{datofamiliar}/create', 'create')->name('datofamiliars.create');
    Route::post('datofamiliars/store', 'store')->name('datofamiliars.store');
    Route::get('datofamiliars/{datofamiliar}/edit', 'edit')->name('datofamiliars.edit');
    Route::put('datofamiliars/{datofamiliar}', 'update')->name('datofamiliars.update'); 
});
Route::resource('industrias', IndustriaController::class)->names('industrias');
Route::resource('marcas', MarcaController::class)->names('marcas');
Route::resource('modelos', ModeloController::class)->names('modelos');
Route::resource('situacions', SituacionController::class)->names('situacions');
Route::controller(Armamento_UserController::class)->group(function () {
    Route::get('armamentos_users/{armamento_user}/{tipo}/create', 'create')->name('armamentos_users.create');
    Route::post('armamentos_users/store', 'store')->name('armamentos_users.store');
    Route::get('armamentos_users/{armamento_user}/show', 'show')->name('armamentos_users.show');
    Route::get('armamentos_users/{armamento_user}/edit', 'edit')->name('armamentos_users.edit');
    Route::put('armamentos_users/{armamento_user}', 'update')->name('armamentos_users.update');
});
Route::resource('tipos', TipoController::class)->names('tipos');
Route::resource('ubicacions', UbicacionController::class)->names('ubicacions');
Route::resource('unidads', UnidadController::class)->names('unidads');
Route::controller(UnidadController::class)->group( function () {
    Route::get('unidads/{unidad}/novedads', 'novedads')->name('unidads.novedads');
    Route::get('unidads/{unidad}/novedads_uu_dd', 'novedads_uu_dd')->name('unidads.novedads_uu_dd');
    Route::get('unidads/{unidad}/novedads_fechas', 'novedads_fechas')->name('unidads.novedads_fechas');
    Route::post('unidads/rango', 'rango')->name('unidads.rango');
});
//Route::resource('destinos', DestinoController::class)->names('destinos');
Route::controller(DestinoController::class)->group(function () {
    Route::get('destinos/{user}/create', 'create')->name('destinos.create');
    Route::post('destinos/store', 'store')->name('destinos.store');
    Route::get('destinos/{destino}/edit', 'edit')->name('destinos.edit');
    Route::get('destinos/{destino}', 'index_destinados')->name('destinos.index_destinados');
    Route::get('destinos/{destino}/uu_dd', 'index_destinados_uu_dd')->name('destinos.index_destinados_uu_dd');
    Route::put('destinos/{destino}', 'update')->name('destinos.update');
    Route::get('destinos/{destino}/cambiar_destino', 'cambiar_destino')->name('destinos.cambiar_destino');
    Route::post('destinos/store_cambio', 'store_cambio')->name('destinos.store_cambio');
});
Route::resource('novedads', NovedadController::class)->names('novedads');
Route::controller(Destino_NovedadController::class)->group(function () {
    Route::get('destinos_novedads/{user}/create', 'create')->name('destinos_novedads.create');
    Route::post('destinos_novedads/store', 'store')->name('destinos_novedads.store');
    Route::get('destinos_novedads/{user}', 'show')->name('destinos_novedads.show');
    Route::get('destinos_novedads/{destino_novedad}/eliminar', 'eliminar')->name('destinos_novedads.eliminar');
    Route::delete('destinos_novedads', 'destroy')->name('destinos_novedads.destroy');
});
Route::resource('permissions', PermissionController::class)->names('permissions');
Route::resource('roles', RoleController::class)->names('roles');
Route::controller(VariosController::class)->group(function () {
    Route::get('varios/edit_gs', 'edit_gs')->name('varios.edit_gs');
});
// ROUTES DEL MATERIAL BELICO

Route::get('matbels', [MatbelController::class, 'index']);
Route::get('add-matbel', [MatbelController::class, 'create']);
Route::post('add-matbel', [MatbelController::class, 'store']);
Route::get('edit-matbel/{id}', [MatbelController::class, 'edit']);
Route::put('update-matbel/{id}', [MatbelController::class, 'update']);
Route::delete('delete-matbel/{id}', [MatbelController::class, 'destroy']);
Route::get('show-matbel/{id}', [MatbelController::class, 'show']);
//PDF
Route::get('/generar-pdf', 'PdfController@generarPDF')->name('pdf.generate');
//tipo de armamento
Route::get('tipo_armamentos', [Tipo_armamentoController::class, 'index']);
Route::get('add-tipo', [Tipo_armamentoController::class, 'create']);
Route::post('add-tipo', [Tipo_armamentoController::class, 'store']);
Route::get('edit-tipo/{id}', [Tipo_armamentoController::class, 'edit']);
Route::put('update-tipo/{id}', [Tipo_armamentoController::class, 'update']);
Route::delete('delete-tipo/{id}', [Tipo_armamentoController::class, 'destroy']);
Route::get('show-tipo/{id}', [Tipo_armamentoController::class, 'show']);
//salida de armamento
Route::get('salida_armamentos', [Tipo_armamentoController::class, 'index']);
Route::get('add-salida', [Tipo_armamentoController::class, 'create']);
Route::post('add-salida', [Tipo_armamentoController::class, 'store']);
Route::get('edit-salida/{id}', [Tipo_armamentoController::class, 'edit']);
Route::put('update-salida/{id}', [Tipo_armamentoController::class, 'update']);
Route::delete('delete-salida/{id}', [Tipo_armamentoController::class, 'destroy']);
Route::get('show-salida/{id}', [Tipo_armamentoController::class, 'show']);