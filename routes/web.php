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
Route::get('/guardarEnBaseDatos', [App\Http\Controllers\APIController::class,'guardarMunicipiosJSONenBD']);


Route::get('/ProvinciaBarcelona', [\App\Http\Controllers\APIController::class, 'mostrarPueblosProvinciaBarcelona']);
Route::get('/ProvinciaGirona', [\App\Http\Controllers\APIController::class, 'mostrarPueblosProvinciaGirona']);
Route::get('/ProvinciaLleida', [\App\Http\Controllers\APIController::class, 'mostrarPueblosProvinciaLleida']);
Route::get('/ProvinciaTarragona', [App\Http\Controllers\APIController::class,'mostrarPueblosProvinciaTarragona']);
