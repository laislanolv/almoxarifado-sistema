<?php

namespace Estoque\Http\Controllers;

use Estoque\Estado;

use Estoque\Organizacao;
use Illuminate\Http\Request;
use Estoque\Http\Requests\OrganizacoesRequest;

class OrganizacoesController extends Controller {
    public function index() {
        $organizacoes = Organizacao::orderBy('id', 'asc')->paginate(10);
        return view('organizacoes.index', compact('organizacoes'))->with('limite_texto', '30');
    }

    public function create() {
        $estados = Estado::pluck('nome', 'id');
        return view('organizacoes.create', compact('estados'));
    }

    public function store(OrganizacoesRequest $request) {
        Organizacao::create($request->except('estado'));
        return redirect()->route('organizacoes.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Organizacao $organizacao) {
        return view('organizacoes.show', compact('organizacao'));
    }

    public function edit(Organizacao $organizacao) {
        $estados = Estado::pluck('nome', 'id');
        return view('organizacoes.edit', compact('estados', 'organizacao'));
    }

    public function update(OrganizacoesRequest $request, Organizacao $organizacao) {
        $organizacao->update($request->except('estado'));
        return redirect()->route('organizacoes.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Organizacao::destroy($id);
        return redirect()->route('organizacoes.index')->with('success', 'Deletado com sucesso!');
    }
}
