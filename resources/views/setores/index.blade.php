@extends('layouts.default')
@section('title', 'Setores')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('setores.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($setores->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhum Setor encontrado</th>
                    </tr>
                @else
                    @foreach ($setores as $setor)
                        <tr>
                            <td>{{ $setor->id }}</td>
                            <td>{{ $setor->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($setor->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($setor->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('setores.show', $setor->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('setores.edit', $setor->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-danger" title="Excluir" data-toggle="modal" data-target="#modal_excluir"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </section>

    <section class="text-center">
        {{ $setores->render() }}
        <h6><b>{{ $setores->total() }}</b> {{ $setores->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
    
    @if($setores->total() > 0)
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
                            {!! Form::open(['method' => 'delete', 'route' => ['setores.destroy', $setor->id], 'style'=>'display: inline']) !!}
                            {!! Form::submit('Sim', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
