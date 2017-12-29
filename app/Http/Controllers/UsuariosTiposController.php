<?php

namespace Estoque\Http\Controllers;

use Estoque\UsuarioTipo;
use Illuminate\Http\Request;
use Estoque\Http\Requests\UsuariosTiposRequest;

class UsuariosTiposController extends Controller {
    public function index() {
        $tipos = UsuarioTipo::orderBy('id', 'asc')->paginate(10);
        return view('tipos-usuarios.index', compact('tipos'));
    }

    public function create() {
        return view('tipos-usuarios.create');
    }

    public function store(UsuariosTiposRequest $request) {
        UsuarioTipo::create($request->all());
        return redirect()->route('tipos-usuarios.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(UsuarioTipo $tipo) {
        return view('tipos-usuarios.show', compact('tipo'));
    }

    public function edit(UsuarioTipo $tipo) {
        return view('tipos-usuarios.edit', compact('tipo'));
    }

    public function update(UsuariosTiposRequest $request, UsuarioTipo $tipo) {
        $tipo->update($request->all());
        return redirect()->route('tipos-usuarios.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        UsuarioTipo::destroy($id);
        return redirect()->route('tipos-usuarios.index')->with('success', 'Deletado com sucesso!');
    }
}
