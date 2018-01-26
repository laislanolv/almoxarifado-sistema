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

// Saídas
Route::group(['prefix' => 'saidas'], function () {
    Route::get('/{saida}/add-item', 'SaidasController@createItem')->name('saidas.add-item.create');
    Route::post('/{saida}/add-item', 'SaidasController@storeItem')->name('saidas.add-item.store');
    Route::delete('/{saida}/del-item', 'SaidasController@destroyItem')->name('saidas.del-item.destroy');
    Route::match(['put', 'patch'], '/{saida}/end', 'SaidasController@storeEnd')->name('saidas.end.store');
});
Route::resource('saidas', 'SaidasController');

// Organizações
Route::resource('organizacoes', 'OrganizacoesController', ['parameters' => ['organizacoes' => 'organizacao']]);

// Fornecedores
Route::resource('fornecedores', 'FornecedoresController', ['parameters' => ['fornecedores' => 'fornecedor']]);
