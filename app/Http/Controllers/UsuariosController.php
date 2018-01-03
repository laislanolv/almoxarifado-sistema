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
        Usuario::create($data);
        return redirect()->route('usuarios.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function show(Usuario $usuario) {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario) {
        $tipos = UsuarioTipo::pluck('nome', 'id');
        $organizacoes = Organizacao::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        return view('usuarios.edit', compact('tipos', 'organizacoes', 'departamentos', 'usuario'));
    }

    public function update(UsuariosRequest $request, Usuario $usuario) {
        $data = $request->all();

        if ($request->senha == null) {
            unset($data['senha']);
        } else {
            $data['senha'] = Usuario::encryptSenha($request->senha);
        }

        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        Usuario::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Deletado com sucesso!');
    }
}
