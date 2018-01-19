@extends('layouts.default')
@section('title', 'Usuários')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($usuarios->total() == 0)
                    <tr>
                        <th class="text-center" colspan="5">Nenhum Usuário encontrado</th>
                    </tr>
                @else
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($usuario->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($usuario->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($usuarios->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $usuario->id, 'method' => 'delete', 'route' => ['usuarios.destroy', $usuario->id], 'style'=>'display: inline']) !!}
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
        {{ $usuarios->render() }}
        <h6><b>{{ $usuarios->total() }}</b> {{ $usuarios->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($usuarios->total() > 0)
    @section('scripts')
        <script src="{{ asset('/js/modal-excluir.js') }}"></script>
    @endsection
@endif

