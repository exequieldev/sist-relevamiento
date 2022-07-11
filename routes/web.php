<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\ManzanaController;

use App\Http\Controllers\CasaController;

use App\Http\Controllers\LoteController;
use App\Http\Controllers\DetalleConstruccionController;

use App\Http\Controllers\RelevamientoController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\DetalleHabitacionController;
use App\Http\Controllers\VinculoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\OcupacionController;
use App\Http\Controllers\SituacionOcupacionalController;
use App\Http\Controllers\PatologiaController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\MovimientoSocialController;

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
    return view('welcome');
});



Route::resource('/barrio',BarrioController::class);
Route::resource('/manzana',ManzanaController::class);
Route::resource('/lote',LoteController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/construccion',ConstruccionController::class);
Route::resource('/detalleconstruccion',DetalleConstruccionController::class);
Route::resource('/relevamiento',RelevamientoController::class);
Route::resource('/detallehabitacion',DetalleHabitacionController::class);
Route::resource('/vinculo', VinculoController::class);
Route::resource('/genero', GeneroController::class);
Route::resource('/ocupacion', OcupacionController::class);
Route::resource('/situacionocupacional', SituacionOcupacionalController::class);
Route::resource('/patologia', PatologiaController::class);
Route::resource('/nivel', NivelController::class);
Route::resource('/movimientosocial',MovimientoSocialController::class);