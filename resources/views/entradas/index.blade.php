@extends('layouts.default')
@section('title', 'Entradas')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
            <strong>{{ session('danger') }}</strong>
        </div>
    @endif
    <section class="table-responsive">
        <a href="{{ route('entradas.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Número da Nota</th>
                <th>Data da Nota</th>
                <th>Observações</th>
                <th>Status</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($entradas->total() == 0)
                    <tr>
                        <th class="text-center" colspan="6">Nenhuma Entrada encontrada</th>
                    </tr>
                @else
                    @foreach ($entradas as $entrada)
                        <tr>
                            <td>{{ $entrada->id }}</td>
                            <td>{{ $entrada->numero_nota }}</td>
                            <td>{{ \Carbon\Carbon::parse($entrada->data)->format('d/m/Y') }}</td>
                            <td>
                                @if ($entrada->observacoes != null)
                                    @if (strlen($entrada->observacoes) > $limite_texto)
                                        {{ substr($entrada->observacoes, 0, $limite_texto) . '...' }}
                                    @else
                                        {{ $entrada->observacoes }}
                                    @endif
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if ($entrada->status == 0)
                                    <span class="label label-default">Inativo</span>
                                @else
                                    <span class="label label-success">Ativo</span>
                                @endif
                            </td>
                            <td>
                                <!-- <a href="{{ route('entradas.show', $entrada->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a> -->
                                <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($entradas->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $entrada->id, 'method' => 'delete', 'route' => ['entradas.destroy', $entrada->id], 'style'=>'display: inline']) !!}
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
        {{ $entradas->render() }}
        <h6><b>{{ $entradas->total() }}</b> {{ $entradas->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($entradas->total() > 0)
    @section('scripts')
        <script src="{{ asset('/js/modal-excluir.js') }}"></script>
    @endsection
@endif
