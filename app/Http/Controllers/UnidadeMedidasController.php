<?php

namespace Estoque\Http\Controllers;

use Estoque\UnidadeMedida;
use Illuminate\Http\Request;
use Estoque\Http\Requests\UnidadeMedidasRequest;

class UnidadeMedidasController extends Controller {
    public function index() {
        $unidades = UnidadeMedida::orderBy('id', 'asc')->paginate(10);
        return view('unidades.index', compact('unidades'));
    }

    public function create() {
        return view('unidades.create');
    }

    public function store(UnidadeMedidasRequest $request) {
        UnidadeMedida::create($request->all());
        return redirect()->route('unidades.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(UnidadeMedida $unidade) {
        return view('unidades.show', compact('unidade'));
    }

    public function edit(UnidadeMedida $unidade) {
        return view('unidades.edit', compact('unidade'));
    }

    public function update(UnidadeMedidasRequest $request, UnidadeMedida $unidade) {
        $unidade->update($request->all());
        return redirect()->route('unidades.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        UnidadeMedida::destroy($id);
        return redirect()->route('unidades.index')->with('success', 'Deletado com sucesso!');
    }
}
