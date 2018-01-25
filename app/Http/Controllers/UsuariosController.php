<?php

namespace Estoque\Http\Controllers;

use Estoque\UsuarioTipo;
use Estoque\Organizacao;
use Estoque\Departamento;

use Estoque\Usuario;
use Illuminate\Http\Request;
use Estoque\Http\Requests\UsuariosRequest;

class UsuariosController extends Controller {
    public function index() {
        $usuarios = Usuario::orderBy('id', 'asc')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        $tipos = UsuarioTipo::pluck('nome', 'id');
        $organizacoes = Organizacao::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        return view('usuarios.create', compact('tipos', 'organizacoes', 'departamentos'));
    }

    public function store(UsuariosRequest $request) {
        $data = $request->all();
        $data['senha'] = Usuario::encryptSenha($request->senha);
        $usuario = Usuario::create($data);
        $usuario->departamentos()->attach($data['departamentos']);
        return redirect()->route('usuarios.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Usuario $usuario) {
        $departamentos = $usuario->departamentos->pluck('nome');
        return view('usuarios.show', compact('departamentos', 'usuario'));
    }

    public function edit(Usuario $usuario) {
        $tipos = UsuarioTipo::pluck('nome', 'id');
        $organizacoes = Organizacao::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        $departamentos_selecionados = $usuario->departamentos()->pluck('id_departamento');
        return view('usuarios.edit', compact('tipos', 'organizacoes', 'departamentos', 'departamentos_selecionados', 'usuario'));
    }

    public function update(UsuariosRequest $request, Usuario $usuario) {
        $data = $request->all();

        if ($request->senha) {
            $data['senha'] = Usuario::encryptSenha($request->senha);
        } else {
            unset($data['senha']);
        }

        $usuario->update($data);
        $usuario->departamentos()->sync($data['departamentos']);
        return redirect()->route('usuarios.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy(Usuario $usuario) {
        $usuario->departamentos()->detach();
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Deletado com sucesso!');
    }
}
