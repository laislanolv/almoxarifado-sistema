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
                                <a href="#" class="btn btn-danger" title="Excluir" data-toggle="modal" data-target="#modal_excluir"><i class="fa fa-trash"></i></a>
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
    
    @if($produtos->total() > 0)
        <div id="modal_excluir" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Atenção!</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja mesmo excluir?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                            {!! Form::open(['method' => 'delete', 'route' => ['produtos.destroy', $produto->id], 'style'=>'display: inline']) !!}
                            {!! Form::submit('Sim', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
