<?php

namespace Estoque\Http\Controllers;

use Estoque\Categoria;

use Illuminate\Http\Request;
use Estoque\Http\Requests\CategoriasRequest;

class CategoriasController extends Controller {
    public function index() {
        $categorias = Categoria::orderBy('id', 'asc')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function create() {
        return view('categorias.create');
    }

    public function store(CategoriasRequest $request) {
        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Categoria $categoria) {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria) {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(CategoriasRequest $request, Categoria $categoria) {
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Categoria::destroy($id);
        return redirect()->route('categorias.index')->with('success', 'Deletado com sucesso!');
    }
}
