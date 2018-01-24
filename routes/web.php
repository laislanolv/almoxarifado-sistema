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

// Tipos de Usuários
Route::resource('tipos-usuarios', 'UsuariosTiposController', ['parameters' => ['tipos-usuarios' => 'tipo']]);

// Usuários
Route::resource('usuarios', 'UsuariosController');

// Tipos de Usuários
Route::resource('fontes-recursos', 'FontesRecursosController', ['parameters' => ['fontes-recursos' => 'fonte']]);

// Departamentos
Route::resource('departamentos', 'DepartamentosController');

// Setores
Route::resource('setores', 'SetoresController', ['parameters' => ['setores' => 'setor']]);

// Marcas
Route::resource('marcas', 'MarcasController');

// Unidade de Medidas
Route::resource('unidades', 'UnidadeMedidasController');

// Categorias
Route::resource('categorias', 'CategoriasController');

// Produtos
Route::get('produtos/find', ['as' => 'produtos.find', 'uses' => 'ProdutosController@find']);
Route::resource('produtos', 'ProdutosController');

// Entradas
Route::group(['prefix' => 'entradas'], function () {
    Route::get('/{entrada}/add-item', ['as' => 'entradas.add-item.create', 'uses' => 'EntradasController@createItem']);
    Route::post('/{entrada}/add-item', ['as' => 'entradas.add-item.store', 'uses' => 'EntradasController@storeItem']);
    Route::delete('/{entrada}/del-item', ['as' => 'entradas.del-item.destroy', 'uses' => 'EntradasController@destroyItem']);
    Route::match(['put', 'patch'], '/{entrada}/end', ['as' => 'entradas.end.store', 'uses' => 'EntradasController@storeEnd']);
    Route::match(['put', 'patch'], '/{entrada}/del-attachment', ['as' => 'entradas.del-attachment.destroy', 'uses' => 'EntradasController@destroyAttachment']);
});
Route::resource('entradas', 'EntradasController');

// Organizações
Route::resource('organizacoes', 'OrganizacoesController', ['parameters' => ['organizacoes' => 'organizacao']]);

// Fornecedores
Route::resource('fornecedores', 'FornecedoresController', ['parameters' => ['fornecedores' => 'fornecedor']]);

// Cidades
Route::get('cidades/{estado}', ['as' => 'cidades.show', 'uses' => 'CidadesController@getCidades']);
