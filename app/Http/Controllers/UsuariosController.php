<?php

namespace Estoque\Http\Controllers;

use Estoque\UsuarioTipo;
use Estoque\Organizacao;
use Estoque\Departamento;
use Estoque\UsuarioDepartamento;

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
        $this->storeDepartamentos($usuario, $data['departamentos']);
        return redirect()->route('usuarios.index')->with('success', 'Cadastrado com sucesso!');
    }

    public function storeDepartamentos($usuario, $departamentos) {
        $data = [];

        foreach($departamentos as $key => $val) {
            $data[$key] = ['id_usuario' => $usuario->id, 'id_departamento' => $val];
        }

        UsuarioDepartamento::where('id_usuario', $usuario->id)->delete();
        UsuarioDepartamento::insert($data);
    }

    public function show(Usuario $usuario) {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario) {
        $tipos = UsuarioTipo::pluck('nome', 'id');
        $organizacoes = Organizacao::pluck('nome', 'id');
        $departamentos = Departamento::pluck('nome', 'id');
        $departamentos_selecionados = UsuarioDepartamento::where('id_usuario', $usuario->id)->pluck('id_departamento');
        return view('usuarios.edit', compact('tipos', 'organizacoes', 'departamentos', 'departamentos_selecionados', 'usuario'));
    }

    public function update(UsuariosRequest $request, Usuario $usuario) {
        $data = $request->all();

        if ($request->senha == null) {
            unset($data['senha']);
        } else {
            $data['senha'] = Usuario::encryptSenha($request->senha);
        }

        $usuario->update($data);
        $this->storeDepartamentos($usuario, $data['departamentos']);
        return redirect()->route('usuarios.index')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id) {
        UsuarioDepartamento::where('id_usuario', $id)->delete();
        Usuario::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Deletado com sucesso!');
    }
}
