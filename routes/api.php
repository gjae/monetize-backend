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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'cuentas'], function(){
	Route::get('/', 'CuentasController@index');
	Route::post('/movimiento', 'CuentasController@addMovimiento');
	Route::post('/crear','CuentasController@nueva');
});

Route::group(['prefix' => 'banco'], function(){
	Route::get('/get', 'BancosController@get');
});