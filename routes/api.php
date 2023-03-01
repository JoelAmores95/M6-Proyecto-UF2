<?php

use App\Http\Controllers\ComarcaAPIController;
use App\Http\Controllers\MunicipioAPIController;
use App\Http\Controllers\ProvinciaAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('municipio', MunicipioAPIController::class)->only([
    'index', 'update', 'show'
]);
Route::resource('provincia', ProvinciaAPIController::class)->only([
    'index', 'show'
]);
Route::resource('comarca', ComarcaAPIController::class)->only([
    'index', 'show'
]);
