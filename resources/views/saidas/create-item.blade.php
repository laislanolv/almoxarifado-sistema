@extends('layouts.default')
@section('title', 'Saídas - Editar')

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
                <h2>Editar Saída</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('saidas.index') }}">Voltar</a>
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
                <a href="{{ route('saidas.edit', $saida->id) }}" class="btn btn-default btn-circle"><i class="fa fa-file-text-o"></i></a>
                <p><b>Cabeçalho da Saída</b></p>
            </div>
            <div class="stepwizard-step">
                <a href="{{ route('saidas.add-item.create', $saida->id) }}" class="btn btn-primary btn-circle"><i class="fa fa-list-ol"></i></a>
                <p><b>Itens da Saída</b></p>
            </div>
            <div class="stepwizard-step">
                {!! Form::open(['method' => 'patch', 'route' => ['saidas.end.store', $saida->id], 'style'=>'display: inline']) !!}
                {!! Form::button('<i class="fa fa-check"></i>', ['id' => 'btn_form_saidas_end', 'class' => 'btn btn-default btn-circle']) !!}
                {!! Form::close() !!}
                <p><b>Finalizar Saída</b></p>
            </div>
        </div>
    </div>
    
    @include('saidas.form-step2')
    
@endsection
