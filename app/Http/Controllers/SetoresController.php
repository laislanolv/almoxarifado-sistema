<?php

namespace Estoque\Http\Controllers;

use Estoque\Departamento;
use Estoque\Setor;
use Illuminate\Http\Request;
use Estoque\Http\Requests\SetoresRequest;

class SetoresController extends Controller {
    public function index() {
        $setores = Setor::orderBy('id', 'asc')->paginate(10);
        return view('setores.index', compact('setores'));
    }

    public function create() {
        $departamentos = Departamento::pluck('nome', 'id');
        return view('setores.create', compact('departamentos'));
    }

    public function store(SetoresRequest $request) {
        Setor::create($request->all());
        return redirect()->route('setores.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Setor $setor) {
        return view('setores.show', compact('setor'));
    }

    public function edit(Setor $setor) {
        $departamentos = Departamento::pluck('nome', 'id');
        return view('setores.edit', compact('departamentos', 'setor'));
    }

    public function update(SetoresRequest $request, Setor $setor) {
        $setor->update($request->all());
        return redirect()->route('setores.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Setor::destroy($id);
        return redirect()->route('setores.index')->with('success', 'Deletado com sucesso!');
    }
}
