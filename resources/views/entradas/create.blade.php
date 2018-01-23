@extends('layouts.default')
@section('title', 'Entradas - Cadastrar')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            <strong>{{ session('danger') }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Cadastrar Entradas</h2>
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
                <a href="#" class="btn btn-primary btn-circle"><i class="fa fa-file-text-o"></i></a>
                <p><b>Cabeçalho da Nota</b></p>
            </div>
            <div class="stepwizard-step">
                <a href="#" class="btn btn-default btn-circle" disabled><i class="fa fa-list-ol"></i></a>
                <p><b>Itens da Nota</b></p>
            </div>
            <div class="stepwizard-step">
                <a href="#" class="btn btn-default btn-circle" disabled><i class="fa fa-check"></i></a>
                <p><b>Finalizar Entrada</b></p>
            </div>
        </div>
    </div>

    {!! Form::open(array('id' => 'form_entradas_step1', 'method' => 'post', 'files' => true, 'route' => 'entradas.store')) !!}
        {!! Form::hidden('id_usuario', isset($entrada) ? $entrada->id_usuario : '1') !!}
        @include('entradas.form-step1')
    {!! Form::close() !!}
    
@endsection
