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
/*
Route::get('inicio',[InicioController::class,'index']);
Route::get('/barrio',[BarrioController::class,'index']);
Route::get('/barrio/create',[BarrioController::class,'create']);
*/
//Route::put('barrio/{id}',[BarrioController::class,'update'])->name('barrio.update');


Route::resource('/barrio',BarrioController::class);
Route::resource('/manzana',ManzanaController::class);
<<<<<<< HEAD
Route::resource('/lote',LoteController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/construccion',ConstruccionController::class);
Route::resource('/detalleconstruccion',DetalleConstruccionController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
Route::resource('/barrio',BarrioController::class);
=======


Route::resource('/casa',CasaController::class);

Route::resource('/lote',LoteController::class);

Route::resource('/construccion',ConstruccionController::class);

Route::resource('/relevamiento',RelevamientoController::class);

>>>>>>> c022640433b94584be4d6ebe488bba4a09bcc5e0

