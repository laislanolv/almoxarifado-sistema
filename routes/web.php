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
Route::get('/', 'HomeController@index');

// Marcas
Route::resource('marcas', 'MarcasController');

// Unidade de Medidas
Route::resource('unidades', 'UnidadeMedidasController');

// Categorias
Route::resource('categorias', 'CategoriasController');

// Produtos
Route::resource('produtos', 'ProdutosController');

// Organizações
Route::resource('organizacoes', 'OrganizacoesController', ['parameters' => [
    'organizacoes' => 'organizacao'
]]);

// Cidades
Route::get('cidades/{estado}', 'CidadesController@getCidades');
