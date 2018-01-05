<?php

namespace Estoque\Http\Controllers;

use Estoque\Marca;
use Estoque\Categoria;
use Estoque\UnidadeMedida;

use Estoque\Produto;
use Illuminate\Http\Request;
use Estoque\Http\Requests\ProdutosRequest;

class ProdutosController extends Controller {
    public function index() {
        $produtos = Produto::orderBy('id', 'asc')->paginate(10);
        return view('produtos.index', compact('produtos'))->with('limite_texto', '30');
    }

    public function create() {
        $marcas = Marca::pluck('nome', 'id');
        $categorias = Categoria::pluck('nome', 'id');
        $unidades = UnidadeMedida::pluck('nome', 'id');
        return view('produtos.create', compact('marcas', 'categorias', 'unidades'));
    }

    public function store(ProdutosRequest $request) {
        Produto::create($request->all());
        return redirect()->route('produtos.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Produto $produto) {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto) {
        $marcas = Marca::pluck('nome', 'id');
        $categorias = Categoria::pluck('nome', 'id');
        $unidades = UnidadeMedida::pluck('nome', 'id');
        return view('produtos.edit', compact('marcas', 'categorias', 'unidades', 'produto'));
    }

    public function update(ProdutosRequest $request, Produto $produto) {
        $produto->update($request->all());
        return redirect()->route('produtos.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Produto::destroy($id);
        return redirect()->route('produtos.index')->with('success', 'Deletado com sucesso!');
    }
}
