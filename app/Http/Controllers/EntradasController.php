<?php

namespace Estoque\Http\Controllers;

use Estoque\Usuario;
use Estoque\Departamento;
use Estoque\Fornecedor;
use Estoque\FonteRecurso;
use Estoque\Produto;

use Estoque\Entrada;
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
        $data = [
            'numero_lote' => $request->numero_lote,
            'vencimento_lote' => $request->vencimento_lote ? Entrada::formatData($request->vencimento_lote) : null,
            'quantidade' => $request->quantidade,
            'valor_unitario' => $request->valor_unitario
        ];

        $produto = Produto::find($request->id_produto);
        $entrada->produtos()->attach($produto->id, $data);
        return redirect()->route('entradas.add-item.create', $entrada->id)->with('success', 'Produto inserido!');
    }

    public function destroyItem(Request $request, Entrada $entrada) {
        $entrada->produtos()->wherePivot('id', $request->id_item)->detach();
        return redirect()->route('entradas.add-item.create', $entrada->id)->with('success', 'Produto deletado!');
    }

    public function createEnd(Entrada $entrada) {
        return view('entradas.end', compact('entrada'));
    }

    public function storeEnd(Entrada $entrada) {}

    public function edit(Entrada $entrada) {
        // A entrada #entrada já está finalizada e não é mais possível editar.
        // redirect para vizualizar
        $departamentos = Departamento::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('entradas.edit', compact('departamentos', 'fornecedores', 'fontes_recursos', 'entrada'));
    }

    public function update(EntradasRequest $request, Entrada $entrada) {
        $entrada->update($request->all());
        return redirect()->route('entradas.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy(Entrada $entrada) {
        if ($entrada->finalizada == 1) {
            return redirect()->route('entradas.index')->with('danger', 'A entrada #' . $entrada->id . ' já está finalizada e não é mais possível deletar.');
        }

        $entrada->produtos()->detach();
        $entrada->delete();
        return redirect()->route('entradas.index')->with('success', 'Deletado com sucesso!');
    }
}
