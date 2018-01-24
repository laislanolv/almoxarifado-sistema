<?php

namespace Estoque\Http\Controllers;

use Estoque\Almoxarifado;

use Illuminate\Http\Request;
use Estoque\Http\Requests\AlmoxarifadosRequest;

class AlmoxarifadosController extends Controller {
    public function index() {
        $almoxarifados = Almoxarifado::orderBy('id', 'asc')->paginate(10);
        return view('almoxarifados.index', compact('almoxarifados'));
    }

    public function create() {
        return view('almoxarifados.create');
    }

    public function store(AlmoxarifadosRequest $request) {
        Almoxarifado::create($request->all());
        return redirect()->route('almoxarifados.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Almoxarifado $almoxarifado) {
        return view('almoxarifados.show', compact('almoxarifado'));
    }

    public function edit(Almoxarifado $almoxarifado) {
        return view('almoxarifados.edit', compact('almoxarifado'));
    }

    public function update(AlmoxarifadosRequest $request, Almoxarifado $almoxarifado) {
        $almoxarifado->update($request->all());
        return redirect()->route('almoxarifados.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Almoxarifado::destroy($id);
        return redirect()->route('almoxarifados.index')->with('success', 'Deletado com sucesso!');
    }
}
