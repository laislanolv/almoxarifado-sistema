@extends('layouts.default')
@section('title', 'Organizações - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Organização</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('organizacoes.index') }}"> Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cidade:</strong>
            {{ $organizacao->cidade->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $organizacao->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Observações:</strong>
            {{ $organizacao->observacoes }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('organizacoes.edit', $organizacao->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection