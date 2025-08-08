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

Route::post('/login', 'UserController@login');  // ruta pública para login

// Rutas que necesitan estar protegidas con token
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/users','UserController');
    Route::apiResource('/marcas','MarcaController');
    Route::apiResource('/medidas','MedidaController');
    Route::apiResource('/categorias','CategoriaController');
    Route::apiResource('/articulos','ArticuloController');
    Route::get('/inventario/kardex/{articulo}','InventarioController@kardex');
    Route::apiResource('/inventario','InventarioController');
    Route::apiResource('/compras','CompraController');
    Route::apiResource('/ventas','VentaController');
    Route::get('/reportes/ventas/{venta}','VentaController@pdf');
    Route::apiResource('/sucursal','SucursalController');

    // Las rutas que ya tenías en api.php también protegidas:
    Route::apiResource('/cajas','CajaController');
    Route::apiResource('/cajamovimientos','CajaMovimientoController');
    Route::post('/articuloImages/articulo/{articulo}','ArticuloImageController@store');
    Route::post('/articuloImages/articulo/delete/{articuloImage}','ArticuloImageController@destroy');
    Route::get('/articuloImages/articulo/{articulo}','ArticuloImageController@show');

    Route::prefix('dashboard')->group( function() {
        Route::get('/headers','DashboardController@headers');
        Route::get('/sales','DashboardController@sales');
    });
});