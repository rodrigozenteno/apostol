<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\MunicipioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('provincias/{id}/obtener_provincias', [ProvinciaController::class, 'obtener_provincias'])->name('provincias.obtener_provincias');
Route::get('municipios/{id}/obtener_municipios', [MunicipioController::class, 'obtener_municipios'])->name('municipios.obtener_municipios');
Route::get('marcas/{id}/obtener_marcas', [MarcaController::class, 'obtener_marcas'])->name('marcas.obtener_marcas');
Route::get('modelos/{id}/obtener_modelos', [ModeloController::class, 'obtener_modelos'])->name('modelos.obtener_modelos');
Route::get('modelos/{id}/obtener_calibres', [ModeloController::class, 'obtener_calibres'])->name('modelos.obtener_calibres');
