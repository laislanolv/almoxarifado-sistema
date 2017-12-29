@extends('layouts.default')
@section('title', 'Departamentos - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Marca</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('departamentos.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID:</strong>
            {{ $departamento->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $departamento->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cadastro:</strong>
            {{ \Carbon\Carbon::parse($departamento->criado)->format('d/m/Y') }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('departamentos.edit', $departamento->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
