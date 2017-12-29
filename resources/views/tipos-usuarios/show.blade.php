@extends('layouts.default')
@section('title', 'Tipos de Usuários - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Tipo de Usuário</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tipos-usuarios.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID:</strong>
            {{ $tipo->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $tipo->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cadastro:</strong>
            {{ \Carbon\Carbon::parse($tipo->criado)->format('d/m/Y') }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
