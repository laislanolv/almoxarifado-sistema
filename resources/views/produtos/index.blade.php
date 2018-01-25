@extends('layouts.default')
@section('title', 'Produtos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Altura</th>
                <th>Largura</th>
                <th>Peso</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($produtos->total() == 0)
                    <tr>
                        <th class="text-center" colspan="9">Nenhum Produto encontrado</th>
                    </tr>
                @else
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>
                                @if ($produto->descricao != null)
                                    @if (strlen($produto->descricao) > $limite_texto)
                                        {{ substr($produto->descricao, 0, $limite_texto) . '...' }}
                                    @else
                                        {{ $produto->descricao }}
                                    @endif
                                @else
                                    --
                                @endif
                            </td>
                            <td>{{ $produto->altura == null ? '--' : $produto->altura }}</td>
                            <td>{{ $produto->largura == null ? '--' : $produto->largura }}</td>
                            <td>{{ $produto->peso == null ? '--' : $produto->peso }}</td>
                            <td>{{ \Carbon\Carbon::parse($produto->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($produto->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($produtos->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $produto->id, 'method' => 'delete', 'route' => ['produtos.destroy', $produto->id], 'style'=>'display: inline']) !!}
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
        {{ $produtos->render() }}
        <h6><b>{{ $produtos->total() }}</b> {{ $produtos->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($produtos->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif
