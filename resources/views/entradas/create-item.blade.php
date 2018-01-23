@extends('layouts.default')
@section('title', 'Entradas - Editar')

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
                <h2>Editar Entrada</h2>
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
                <p><b>Cabeçalho da Nota</b></p>
            </div>
            <div class="stepwizard-step">
                <a href="{{ route('entradas.add-item.create', $entrada->id) }}" class="btn btn-primary btn-circle"><i class="fa fa-list-ol"></i></a>
                <p><b>Itens da Nota</b></p>
            </div>
            <div class="stepwizard-step">
                {!! Form::open(['method' => 'post', 'route' => ['entradas.end.create', $entrada->id], 'style'=>'display: inline']) !!}
                {!! Form::hidden('valor_total_nota') !!}
                {!! Form::hidden('quantidade_itens_nota') !!}
                {!! Form::button('<i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-circle']) !!}
                {!! Form::close() !!}
                <p><b>Finalizar Entrada</b></p>
            </div>
        </div>
    </div>
    
    @include('entradas.form-step2')
    
@endsection
