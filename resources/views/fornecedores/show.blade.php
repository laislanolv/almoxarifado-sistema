@extends('layouts.default')
@section('title', 'Fornecedores - Visualizar')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Visualizar Fornecedor</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedores.index') }}">Voltar</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ID:</strong>
            {{ $fornecedor->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estado:</strong>
            {{ $fornecedor->cidade->estado->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cidade:</strong>
            {{ $fornecedor->cidade->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CNPJ:</strong>
            {{ $fornecedor->cnpj }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Razão Social:</strong>
            {{ $fornecedor->razao_social }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Fantasia:</strong>
            {{ $fornecedor->nome_fantasia }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {{ $fornecedor->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CEP:</strong>
            {{ $fornecedor->cep }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Logradouro:</strong>
            {{ $fornecedor->logradouro }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Número:</strong>
            {{ $fornecedor->numero == null ? '--' : $fornecedor->numero }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Complemento:</strong>
            {{ $fornecedor->complemento == null ? '--' : $fornecedor->complemento }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone 1:</strong>
            {{ $fornecedor->telefone_1 }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone 2:</strong>
            {{ $fornecedor->telefone_2 == null ? '--' : $fornecedor->telefone_2 }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Observações:</strong>
            {{ $fornecedor->observacoes == null ? '--' : $fornecedor->observacoes }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cadastro:</strong>
            {{ \Carbon\Carbon::parse($fornecedor->criado)->format('d/m/Y') }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-primary" title="Editar">Editar</a>
    </div>
</div>
@endsection
