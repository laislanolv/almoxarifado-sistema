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

// Cidades
Route::get('{estado}/cidades', 'Api\CidadesController')->name('api.cidades.show');

// Setores
Route::get('{departamento}/setores', 'Api\SetoresController')->name('api.setores.show');

// Produtos
Route::get('produtos/entrada/find', 'Api\ProdutosController@getProdutosEntrada')->name('api.produtos.entrada.find');
Route::get('produtos/saida/find', 'Api\ProdutosController@getProdutosSaida')->name('api.produtos.saida.find');
