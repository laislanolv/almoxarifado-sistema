@extends('layouts.default')
@section('title', 'Unidade de Medidas')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('unidades.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($unidades->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhuma Unidade encontrada</th>
                    </tr>
                @else
                    @foreach ($unidades as $unidade)
                        <tr>
                            <td>{{ $unidade->id }}</td>
                            <td>{{ $unidade->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($unidade->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($unidade->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('unidades.show', $unidade->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('unidades.edit', $unidade->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($unidades->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $unidade->id, 'method' => 'delete', 'route' => ['unidades.destroy', $unidade->id], 'style'=>'display: inline']) !!}
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
        {{ $unidades->render() }}
        <h6><b>{{ $unidades->total() }}</b> {{ $unidades->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($unidades->total() > 0)
    @section('scripts')
        <script src="{{ asset('/js/modal-excluir.js') }}"></script>
    @endsection
@endif
