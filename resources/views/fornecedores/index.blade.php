@extends('layouts.default')
@section('title', 'Fornecedores')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Nome Fantasia</th>
                <th>Observações</th>
                <th>Cadastro</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($fornecedores->total() == 0)
                    <tr>
                        <th class="text-center" colspan="6">Nenhum Fornecedor encontrado</th>
                    </tr>
                @else
                    @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->id }}</td>
                            <td>{{ $fornecedor->nome_fantasia }}</td>
                            <td>
                                @if ($fornecedor->observacoes != null)
                                    @if (strlen($fornecedor->observacoes) > $limite_texto)
                                        {{ substr($fornecedor->observacoes, 0, $limite_texto) . '...' }}
                                    @else
                                        {{ $fornecedor->observacoes }}
                                    @endif
                                @else
                                    --
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($fornecedor->criado)->format('d/m/Y') }}</td>
                            <td>
                                @if ($fornecedor->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('fornecedores.show', $fornecedor->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($fornecedores->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $fornecedor->id, 'method' => 'delete', 'route' => ['fornecedores.destroy', $fornecedor->id], 'style'=>'display: inline']) !!}
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
        {{ $fornecedores->render() }}
        <h6><b>{{ $fornecedores->total() }}</b> {{ $fornecedores->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($fornecedores->total() > 0)
    @section('scripts')
        <script src="{{ asset('/js/modal-excluir.js') }}"></script>
    @endsection
@endif
