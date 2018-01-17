@extends('layouts.default')
@section('title', 'Entradas - Finalizar')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Finalizar Entrada</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('entradas.index') }}">Voltar</a>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <strong>Ops!</strong> Verifique os erros.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="stepwizard" style="margin-top: 20px;">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-default btn-circle"><i class="fa fa-file-text-o"></i></a>
                <p>Cabeçalho da Nota</p>
            </div>
            <div class="stepwizard-step">
                <a href="{{ route('entradas.add-item.create', $entrada->id) }}" class="btn btn-default btn-circle"><i class="fa fa-list-ol"></i></a>
                <p>Itens da Nota</p>
            </div>
            <div class="stepwizard-step">
                <a href="{{ route('entradas.end.create', $entrada->id) }}" class="btn btn-primary btn-circle"><i class="fa fa-check"></i></a>
                <p>Finalizar Entrada</p>
            </div>
        </div>
    </div>

    {!! Form::open(array('id' => 'form_entradas_step3', 'method' => 'patch', 'route' => ['entradas.end.store', $entrada->id])) !!}
        @include('entradas.form-step3')
    {!! Form::close() !!}
    
@endsection
