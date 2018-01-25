<?php

namespace Estoque\Http\Controllers;

use Estoque\Usuario;
use Estoque\Almoxarifado;
use Estoque\Fornecedor;
use Estoque\FonteRecurso;
use Estoque\Produto;

use Estoque\Entrada;
use Illuminate\Http\Request;
use Estoque\Http\Requests\EntradasProdutosRequest;
use Estoque\Http\Requests\EntradasRequest;

class EntradasController extends Controller {
    public function __construct() {
        $this->middleware('entrada.check.nota')->except(['index', 'store', 'create', 'show']);
        $this->middleware('entrada.check.itens')->only(['storeEnd']);
        $this->middleware('entrada.check.lote')->only('storeItem');
        $this->middleware('entrada.check.valor.nota')->only(['storeEnd']);;
    }

    public function index() {
        $entradas = Entrada::orderBy('id', 'asc')->paginate(10);
        return view('entradas.index', compact('entradas'))->with('limite_texto', '30');
    }

    public function create() {
        $almoxarifados = Almoxarifado::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('entradas.create', compact('almoxarifados', 'fornecedores', 'fontes_recursos'));
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
        $entrada->produtos()->detach($request->id_produto);
        return redirect()->route('entradas.add-item.create', $entrada->id)->with('success', 'Produto deletado!');
    }

    public function destroyAttachment(Request $request, Entrada $entrada) {
        Entrada::deleteNota($entrada->anexo_nota);
        $entrada->anexo_nota = null;
        $entrada->save();
        $request->session()->put('success', 'Anexo deletado!');
    }

    public function storeEnd(Entrada $entrada) {
        $entrada->finalizada = 1;
        $entrada->save();
        return redirect()->route('entradas.index')->with('success', 'Entrada finalizada!');
    }

    public function show(Entrada $entrada) {
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada) {
        $almoxarifados = Almoxarifado::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('entradas.edit', compact('almoxarifados', 'fornecedores', 'fontes_recursos', 'entrada'));
    }

    public function update(EntradasRequest $request, Entrada $entrada) {
        $data = $request->all();
        $data['data'] = Entrada::formatData($request->data);
        $entrada->update($data);
        return redirect()->route('entradas.edit', $entrada->id)->with('success', 'Editado com sucesso!');
    }

    public function destroy(Entrada $entrada) {
        $entrada->produtos()->detach();
        $entrada->delete();
        return redirect()->route('entradas.index')->with('success', 'Deletado com sucesso!');
    }
}
