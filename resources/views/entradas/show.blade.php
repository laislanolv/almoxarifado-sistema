@extends('layouts.default')
@section('title', 'Entradas - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Entrada</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('entradas.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
