<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// Marcas
Route::resource('marcas', 'MarcasController');

// Organizações
Route::resource('organizacoes', 'OrganizacoesController', ['parameters' => [
    'organizacoes' => 'organizacao'
]]);

// Cidades
Route::get('cidades/{estado}', 'CidadesController@getCidades');
