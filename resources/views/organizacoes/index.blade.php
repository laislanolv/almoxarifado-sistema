@extends('layouts.default')
@section('title', 'Organizações')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('organizacoes.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Observações</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($organizacoes->total() == 0)
                    <tr>
                        <th class="text-center" colspan="6">Nenhuma Organização encontrada</th>
                    </tr>
                @else
                    @foreach ($organizacoes as $organizacao)
                        <tr>
                            <td>{{ $organizacao->id }}</td>
                            <td>{{ $organizacao->nome }}</td>
                            <td>
                                @if ($organizacao->observacoes != null)
                                    @if (strlen($organizacao->observacoes) > $limite_texto)
                                        {{ substr($organizacao->observacoes, 0, $limite_texto) . '...' }}
                                    @else
                                        {{ $organizacao->observacoes }}
                                    @endif
                                @else
                                    --
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($organizacao->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($organizacao->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('organizacoes.show', $organizacao->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('organizacoes.edit', $organizacao->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($organizacoes->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $organizacao->id, 'method' => 'delete', 'route' => ['organizacoes.destroy', $organizacao->id], 'style'=>'display: inline']) !!}
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
        {{ $organizacoes->render() }}
        <h6><b>{{ $organizacoes->total() }}</b> {{ $organizacoes->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($organizacoes->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif

