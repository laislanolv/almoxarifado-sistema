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
Route::get('/', 'HomeController');

// Tipos de Usuários
Route::resource('tipos-usuarios', 'UsuariosTiposController', ['parameters' => ['tipos-usuarios' => 'tipo']]);

// Usuários
Route::resource('usuarios', 'UsuariosController');

// Tipos de Usuários
Route::resource('fontes-recursos', 'FontesRecursosController', ['parameters' => ['fontes-recursos' => 'fonte']]);

// Almoxarifados
Route::resource('almoxarifados', 'AlmoxarifadosController');

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
Route::get('produtos/find', 'ProdutosController@find')->name('produtos.find');
Route::resource('produtos', 'ProdutosController');

// Entradas
Route::group(['prefix' => 'entradas'], function () {
    Route::get('/{entrada}/add-item', 'EntradasController@createItem')->name('entradas.add-item.create');
    Route::post('/{entrada}/add-item', 'EntradasController@storeItem')->name('entradas.add-item.store');
    Route::delete('/{entrada}/del-item', 'EntradasController@destroyItem')->name('entradas.del-item.destroy');
    Route::match(['put', 'patch'], '/{entrada}/end', 'EntradasController@storeEnd')->name('entradas.end.store');
    Route::match(['put', 'patch'], '/{entrada}/del-attachment', 'EntradasController@destroyAttachment')->name('entradas.del-attachment.destroy');
});
Route::resource('entradas', 'EntradasController');

// Organizações
Route::resource('organizacoes', 'OrganizacoesController', ['parameters' => ['organizacoes' => 'organizacao']]);

// Fornecedores
Route::resource('fornecedores', 'FornecedoresController', ['parameters' => ['fornecedores' => 'fornecedor']]);

// Cidades
Route::get('cidades/{estado}', 'CidadesController')->name('cidades.show');
