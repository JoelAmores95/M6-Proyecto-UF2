<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
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
Route::any('/', [App\Http\Controllers\APIController::class, 'mostrarMunicipios'])->name('/');


Route::get('/buscar-municipio', [APIController::class, 'buscarMunicipio']);
Route::get('/comarca/search',  [APIController::class, 'searchByComarca']);
Route::any('/provincia', [App\Http\Controllers\APIController::class, 'provinciaIndex']);
Route::get('/provincia/search', [App\Http\Controllers\APIController::class, 'provinciaSearch']);


Route::any('/guardarEnBaseDatos', [App\Http\Controllers\APIController::class,'guardarMunicipiosJSONenBD']);

Auth::routes();

Route::resource('municipio', App\Http\Controllers\APIController::class);

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
