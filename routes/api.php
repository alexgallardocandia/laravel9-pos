<?php

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

Route::apiResource('/cajas','CajaController');
Route::apiResource('/cajamovimientos','CajaMovimientoController');
Route::post('/articuloImages/articulo/{articulo}','ArticuloImageController@store');
Route::post('/articuloImages/articulo/delete/{articuloImage}','ArticuloImageController@destroy');
Route::get('/articuloImages/articulo/{articulo}','ArticuloImageController@show');

Route::prefix('dashboard')->group( function() {
    Route::get('/headers','DashboardController@headers');
    Route::get('/sales','DashboardController@sales');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
