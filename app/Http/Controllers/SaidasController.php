<?php

namespace Estoque\Http\Controllers;

use Estoque\Usuario;
use Estoque\Almoxarifado;
use Estoque\Departamento;
use Estoque\FonteRecurso;
use Estoque\Produto;
use Estoque\Entrada;

use Estoque\Saida;
use Illuminate\Http\Request;
use Estoque\Http\Requests\SaidasProdutosRequest;
use Estoque\Http\Requests\SaidasRequest;

class SaidasController extends Controller {
    public function index() {
        $saidas = Saida::orderBy('id', 'asc')->paginate(10);
        return view('saidas.index', compact('saidas'))->with('limite_texto', '30');
    }

    public function create() {
        $almoxarifados = Almoxarifado::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('saidas.create', compact('almoxarifados', 'departamentos', 'fontes_recursos'));
    }

    public function store(SaidasRequest $request) {
        $data = $request->all();
        $data['data'] = Saida::formatData($request->data);
        $saida = Saida::create($data);
        return redirect()->route('saidas.edit', $saida->id)->with('success', 'Nota cadastrada! Cadastre os itens da nota.');
    }

    public function createItem(Saida $saida) {
        $itens = $saida->produtos;
        return view('saidas.create-item', compact('almoxarifados', 'fontes_recursos', 'itens', 'saida'));
    }

    public function storeItem(SaidasProdutosRequest $request, Saida $saida) {
        // Pegar id_entrada_produto do request, fazer uma pesquisa na tabela e retornar id produto

        $data = [
            'id_entrada_produto' => $request->id_entrada_produto,
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade
        ];

        $produto = Produto::find($request->id_produto);
        $saida->produtos()->attach($produto->id, $data);
        return redirect()->route('saidas.add-item.create', $saida->id)->with('success', 'Produto inserido!');
    }

    public function destroyItem(Request $request, Saida $saida) {
        $saida->produtos()->detach($request->id_produto);
        return redirect()->route('saidas.add-item.create', $saida->id)->with('success', 'Produto deletado!');
    }

    public function storeEnd(Saida $saida) {
        $saida->finalizada = 1;
        $saida->save();
        return redirect()->route('saidas.index')->with('success', 'Saida finalizada!');
    }

    public function show(Saida $saida) {
        return view('saidas.show', compact('saida'));
    }

    public function edit(Saida $saida) {
        $almoxarifados = Almoxarifado::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('saidas.edit', compact('almoxarifados', 'departamentos', 'fontes_recursos', 'saida'));
    }

    public function update(SaidasRequest $request, Saida $saida) {
        $data = $request->all();
        $data['data'] = Saida::formatData($request->data);
        $saida->update($data);
        return redirect()->route('saidas.edit', $saida->id)->with('success', 'Editado com sucesso!');
    }

    public function destroy(Saida $saida) {
        $saida->produtos()->detach();
        $saida->delete();
        return redirect()->route('saidas.index')->with('success', 'Deletado com sucesso!');
    }
}
