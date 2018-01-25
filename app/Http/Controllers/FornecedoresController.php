<?php

namespace Estoque\Http\Controllers;

use Estoque\Estado;

use Estoque\Fornecedor;
use Illuminate\Http\Request;
use Estoque\Http\Requests\FornecedoresRequest;

class FornecedoresController extends Controller {
    public function index() {
        $fornecedores = Fornecedor::orderBy('id', 'asc')->paginate(10);
        return view('fornecedores.index', compact('fornecedores'))->with('limite_texto', '30');
    }

    public function create() {
        $estados = Estado::pluck('nome', 'id');
        return view('fornecedores.create', compact('estados'));
    }

    public function store(FornecedoresRequest $request) {
        Fornecedor::create($request->except('estado'));
        return redirect()->route('fornecedores.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Fornecedor $fornecedor) {
        return view('fornecedores.show', compact('fornecedor'));
    }

    public function edit(Fornecedor $fornecedor) {
        $estados = Estado::pluck('nome', 'id');
        return view('fornecedores.edit', compact('estados', 'fornecedor'));
    }

    public function update(FornecedoresRequest $request, Fornecedor $fornecedor) {
        $fornecedor->update($request->except('estado'));
        return redirect()->route('fornecedores.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Fornecedor::destroy($id);
        return redirect()->route('fornecedores.index')->with('success', 'Deletado com sucesso!');
    }
}
