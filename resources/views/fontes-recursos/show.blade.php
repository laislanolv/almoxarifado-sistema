@extends('layouts.default')
@section('title', 'Fontes de Recursos - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Fonte de Recurso</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fontes-recursos.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID:</strong>
            {{ $fonte->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $fonte->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cadastro:</strong>
            {{ \Carbon\Carbon::parse($fonte->criado)->format('d/m/Y') }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('fontes-recursos.edit', $fonte->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
