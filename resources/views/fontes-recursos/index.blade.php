@extends('layouts.default')
@section('title', 'Fontes de Recursos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('fontes-recursos.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($fontes->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhuma Fonte de Recurso encontrada</th>
                    </tr>
                @else
                    @foreach ($fontes as $fonte)
                        <tr>
                            <td>{{ $fonte->id }}</td>
                            <td>{{ $fonte->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($fonte->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($fonte->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('fontes-recursos.show', $fonte->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('fontes-recursos.edit', $fonte->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($fontes->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $fonte->id, 'method' => 'delete', 'route' => ['fontes-recursos.destroy', $fonte->id], 'style'=>'display: inline']) !!}
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
        {{ $fontes->render() }}
        <h6><b>{{ $fontes->total() }}</b> {{ $fontes->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($fontes->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif
