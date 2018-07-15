<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('articulos', 'Articulos\articulos_controller', ['except' => ['create','edit']]);
Route::resource('clientes', 'Clientes\clientes_controller', ['except' => ['create','edit']]);
Route::resource('empresa', 'Empresa\empresa_controller', ['except' => ['create','edit']]);
Route::resource('facturacion', 'Facturacion\facturacion_controller', ['except' => ['create','edit']]);
Route::resource('impuestos', 'Impuestos\impuestos_controller', ['except' => ['create','edit']]);
Route::resource('imp_art', 'Impuestos\imp_art_controller', ['except' => ['create','edit']]);

