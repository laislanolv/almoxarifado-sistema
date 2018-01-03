@extends('layouts.default')
@section('title', 'Setores - Cadastrar')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Cadastrar Setores</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('setores.index') }}">Voltar</a>
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

    {!! Form::open(array('id' => 'form_setores', 'method' => 'post', 'route' => 'setores.store')) !!}
        @include('setores.form')
    {!! Form::close() !!}
@endsection
