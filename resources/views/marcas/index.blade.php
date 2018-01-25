@extends('layouts.default')
@section('title', 'Marcas')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($marcas->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhuma Marca encontrada</th>
                    </tr>
                @else
                    @foreach ($marcas as $marca)
                        <tr>
                            <td>{{ $marca->id }}</td>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($marca->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($marca->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('marcas.show', $marca->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($marcas->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $marca->id, 'method' => 'delete', 'route' => ['marcas.destroy', $marca->id], 'style'=>'display: inline']) !!}
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
        {{ $marcas->render() }}
        <h6><b>{{ $marcas->total() }}</b> {{ $marcas->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($marcas->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif
