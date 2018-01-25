@extends('layouts.default')
@section('title', 'Almoxarifados')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('almoxarifados.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($almoxarifados->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhum Almoxarifado encontrado</th>
                    </tr>
                @else
                    @foreach ($almoxarifados as $almoxarifado)
                        <tr>
                            <td>{{ $almoxarifado->id }}</td>
                            <td>{{ $almoxarifado->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($almoxarifado->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($almoxarifado->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('almoxarifados.show', $almoxarifado->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('almoxarifados.edit', $almoxarifado->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($almoxarifados->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $almoxarifado->id, 'method' => 'delete', 'route' => ['almoxarifados.destroy', $almoxarifado->id], 'style'=>'display: inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger modal-excluir']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </section>

    <section class="text-center">
        {{ $almoxarifados->render() }}
        <h6><b>{{ $almoxarifados->total() }}</b> {{ $almoxarifados->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($almoxarifados->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif
