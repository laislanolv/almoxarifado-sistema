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

// Setores
Route::get('{departamento}/setores', 'Api\SetoresController')->name('api.setores.show');

// Cidades
Route::get('{estado}/cidades', 'Api\CidadesController')->name('api.cidades.show');
