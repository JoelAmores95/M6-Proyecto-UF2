<?php

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
// Route::get('/', [App\Http\Controllers\APIController::class,'index']);
Route::get('/', [App\Http\Controllers\APIController::class, 'mostrarMunicipios']);
Route::post('/municipio', [App\Http\Controllers\APIController::class, 'mostrarMunicipio']);
Route::post('/comarca', [App\Http\Controllers\APIController::class, 'mostrarComarca']);
Route::post('/provincia', [App\Http\Controllers\APIController::class, 'mostrarProvincia']);
//Route::get('/show', [App\Http\Controllers\MunicipioController::class, 'show']);
//Route::get('/show', [App\Http\Controllers\MunicipioController::class, 'show']);
Route::get('/guardarEnBaseDatos', [App\Http\Controllers\APIController::class,'guardarMunicipiosJSONenBD']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
