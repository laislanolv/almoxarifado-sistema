<?php

namespace Estoque\Http\Controllers;

use Estoque\Usuario;
use Estoque\Departamento;
use Estoque\Fornecedor;
use Estoque\FonteRecurso;
use Estoque\Produto;

use Estoque\Entrada;
use Illuminate\Http\Request;
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
        if ($request->step == '1') {
            $cabecalho = $this->storeCabecalho($request);
            return redirect()->route('entradas.edit', $cabecalho->id)->with('success', 'Nota cadastrada! Cadastre os itens da nota.');
        } elseif ($request->step == '2') {
            return redirect()->route('entradas.index')->with('success', 'Cadastrado com sucesso!');
        }
    }

    public function storeCabecalho($request) {
        $data = $request->all();
        $data['data'] = Entrada::formatarData($request->data);
        return Entrada::create($data);
    }

    public function show(Entrada $entrada) {
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada) {
        $departamentos = Departamento::pluck('nome', 'id');
        $fornecedores = Fornecedor::pluck('nome_fantasia', 'id');
        $fontes_recursos = FonteRecurso::pluck('nome', 'id');
        return view('entradas.edit', compact('departamentos', 'fornecedores', 'fontes_recursos', 'entrada'));
    }

    public function update(EntradasRequest $request, Entrada $entrada) {
        $entrada->update($request->except(['usuario_nome']));
        return redirect()->route('entradas.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Entrada::destroy($id);
        return redirect()->route('entradas.index')->with('success', 'Deletado com sucesso!');
    }
}
