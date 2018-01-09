<?php

namespace Estoque\Http\Controllers;

use Estoque\FonteRecurso;

use Illuminate\Http\Request;
use Estoque\Http\Requests\FontesRecursosRequest;

class FontesRecursosController extends Controller {
    public function index() {
        $fontes = FonteRecurso::orderBy('id', 'asc')->paginate(10);
        return view('fontes-recursos.index', compact('fontes'));
    }

    public function create() {
        return view('fontes-recursos.create');
    }

    public function store(FontesRecursosRequest $request) {
        FonteRecurso::create($request->all());
        return redirect()->route('fontes-recursos.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(FonteRecurso $fonte) {
        return view('fontes-recursos.show', compact('fonte'));
    }

    public function edit(FonteRecurso $fonte) {
        return view('fontes-recursos.edit', compact('fonte'));
    }

    public function update(FontesRecursosRequest $request, FonteRecurso $fonte) {
        $fonte->update($request->all());
        return redirect()->route('fontes-recursos.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        FonteRecurso::destroy($id);
        return redirect()->route('fontes-recursos.index')->with('success', 'Deletado com sucesso!');
    }
}
