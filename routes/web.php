<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\BarrioController;
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
Route::resource('/barrio',BarrioController::class);
