<?php

namespace Estoque\Http\Controllers;

use Estoque\Departamento;

use Illuminate\Http\Request;
use Estoque\Http\Requests\DepartamentosRequest;

class DepartamentosController extends Controller {
    public function index() {
        $departamentos = Departamento::orderBy('id', 'asc')->paginate(10);
        return view('departamentos.index', compact('departamentos'));
    }

    public function create() {
        return view('departamentos.create');
    }

    public function store(DepartamentosRequest $request) {
        Departamento::create($request->all());
        return redirect()->route('departamentos.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Departamento $departamento) {
        return view('departamentos.show', compact('departamento'));
    }

    public function edit(Departamento $departamento) {
        return view('departamentos.edit', compact('departamento'));
    }

    public function update(DepartamentosRequest $request, Departamento $departamento) {
        $departamento->update($request->all());
        return redirect()->route('departamentos.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Departamento::destroy($id);
        return redirect()->route('departamentos.index')->with('success', 'Deletado com sucesso!');
    }
}
