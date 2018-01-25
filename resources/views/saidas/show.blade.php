@extends('layouts.default')
@section('title', 'Saídas - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Saída</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('saidas.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('saidas.edit', $saida->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
