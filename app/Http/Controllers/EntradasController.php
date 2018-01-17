<?php

namespace Estoque\Http\Controllers;

use Estoque\Usuario;
use Estoque\Departamento;
use Estoque\Fornecedor;
use Estoque\FonteRecurso;
use Estoque\Produto;

use Estoque\Entrada;
use Estoque\EntradaProduto;
use Illuminate\Http\Request;
use Estoque\Http\Requests\EntradasProdutosRequest;
use Estoque\Http\Requests\EntradasRequest;

class EntradasController extends Controller {
    public function index() {
        $entradas = Entrada::orderBy('id', 'asc')->paginate(10);
        return view('entradas.index', compact('entradas'))->with('limite_texto', '30');
    }

    public function create() {
        $departamentos = Departamento::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        $produtos = Produto::pluck('nome', 'id');
        return view('entradas.create', compact('departamentos', 'fornecedores', 'fontes_recursos', 'produtos'));
    }

    public function store(EntradasRequest $request) {
        $data = $request->all();
        
        if ($request->anexo_nota) {
            $upload = Entrada::uploadNota($request->anexo_nota);
            $data['anexo_nota'] = $upload;
        }

        $data['data'] = Entrada::formatData($request->data);
        $entrada = Entrada::create($data);
        return redirect()->route('entradas.edit', $entrada->id)->with('success', 'Nota cadastrada! Cadastre os itens da nota.');
    }

    public function createItem(Entrada $entrada) {
        $itens = $entrada->produtos;
        return view('entradas.create-item', compact('itens', 'entrada'));
    }

    public function storeItem(EntradasProdutosRequest $request, Entrada $entrada) {
        $data = $request->all();
        $data['id_entrada'] = $entrada->id;

        if ($request->vencimento_lote) {
            $data['vencimento_lote'] = EntradaProduto::formatData($request->vencimento_lote);        
        }

        EntradaProduto::create($data);
        return redirect()->route('entradas.add-item.create', $entrada->id)->with('success', 'Produto inserido!');
    }

    public function createEnd(Entrada $entrada) {
        return view('entradas.end', compact('entrada'));
    }

    public function storeEnd(Entrada $entrada) {
       
    }

    public function edit(Entrada $entrada) {
        $departamentos = Departamento::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('entradas.edit', compact('departamentos', 'fornecedores', 'fontes_recursos', 'entrada'));
    }

    public function update(EntradasRequest $request, Entrada $entrada) {
        $entrada->update($request->all());
        return redirect()->route('entradas.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Entrada::destroy($id);
        return redirect()->route('entradas.index')->with('success', 'Deletado com sucesso!');
    }
}
