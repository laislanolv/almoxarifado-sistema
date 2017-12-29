<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\MarcasRequest;

class MarcasController extends Controller {
    public function index() {
        $marcas = Marca::orderBy('id', 'asc')->paginate(10);
        return view('marcas.index', compact('marcas'));
    }

    public function create() {
        return view('marcas.create');
    }

    public function store(MarcasRequest $request) {
        Marca::create($request->all());
        return redirect()->route('marcas.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Marca $marca) {
        return view('marcas.show', compact('marca'));
    }

    public function edit(Marca $marca) {
        return view('marcas.edit', compact('marca'));
    }

    public function update(MarcasRequest $request, Marca $marca) {
        $marca->update($request->all());
        return redirect()->route('marcas.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Marca::destroy($id);
        return redirect()->route('marcas.index')->with('success', 'Deletado com sucesso!');
    }
}
