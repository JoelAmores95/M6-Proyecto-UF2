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
Route::any('/', [App\Http\Controllers\APIController::class, 'mostrarMunicipios'])->name('/');


//NO USAR municipio
Route::any('/municipio', [App\Http\Controllers\APIController::class, 'mostrarMunicipio']);

Route::any('/municipio_search', [App\Http\Controllers\APIController::class, 'mostrarMunicipio_search']);


Route::any('/comarca', [App\Http\Controllers\APIController::class, 'mostrarComarca']);
Route::any('/provincia', [App\Http\Controllers\APIController::class, 'mostrarProvincia']);

Route::any('/guardarEnBaseDatos', [App\Http\Controllers\APIController::class,'guardarMunicipiosJSONenBD']);

Auth::routes();

Route::resource('municipio', App\Http\Controllers\APIController::class);

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
