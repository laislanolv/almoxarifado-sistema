@extends('layouts.default')
@section('title', 'Organizações')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{session('success')}}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('organizacoes.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Observações</th>
                <th>Status</th>
                <th>Ações</th>
            </thead>
            <tbody>
                @foreach ($organizacoes as $organizacao)
                    <tr>
                        <td>{{ $organizacao->id }}</td>
                        <td>{{ $organizacao->nome }}</td>
                        <td>{{ $organizacao->observacoes }}</td>
                        <td>
                            @if ($organizacao->status == 0)
                                Inativo
                            @else
                                Ativo
                            @endif    
                        </td>
                        <td>
                            <a href="{{ route('organizacoes.show', $organizacao->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('organizacoes.edit', $organizacao->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger" title="Excluir" data-toggle="modal" data-target="#modal-excluir"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="text-center">
        {{ $organizacoes->render() }}
        <h6><b>{{$organizacoes->total()}}</b> registros no total</h6>
    </section>
    
    <div id="modal-excluir" class="modal fade" tabindex="-1" role="dialog">
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
                        {!! Form::open(['method' => 'DELETE', 'route' => ['organizacoes.destroy', $organizacao->id], 'style'=>'display: inline']) !!}
                        {!! Form::submit('Sim', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection