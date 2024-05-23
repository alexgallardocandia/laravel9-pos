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

Route::group(['prefix'=>'api'],function(){
    Route::post('/login','UserController@login');
    Route::apiResource('/users','UserController');
    Route::apiResource('/marcas','MarcaController');
    Route::apiResource('/medidas','MedidaController');
    Route::apiResource('/categorias','CategoriaController');
    Route::apiResource('/articulos','ArticuloController');
    Route::get('/inventario/kardex/{articulo}','InventarioController@kardex');
    Route::apiResource('/inventario','InventarioController');
    Route::apiResource('/compras','CompraController');
    Route::apiResource('/ventas','VentaController');
    Route::apiResource('/sucursal','SucursalController');
});


Route::get('/', function () {
    return view('welcome');
});


