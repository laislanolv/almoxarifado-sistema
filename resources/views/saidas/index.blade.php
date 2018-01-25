@extends('layouts.default')
@section('title', 'Saídas')

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
        <a href="{{ route('saidas.create') }}" class="btn btn-primary">Cadastrar +</a>

        <table class="table table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Observações</th>
                <th>Finalizada</th>
                <th style="width: 20%;">Ações</th>
            </thead>
            <tbody>
                @if($saidas->total() == 0)
                    <tr>
                        <th class="text-center" colspan="4">Nenhuma Entrada encontrada</th>
                    </tr>
                @else
                    @foreach ($saidas as $saida)
                        <tr>
                            <td>{{ $saida->id }}</td>
                            <td>
                                @if ($saida->observacoes != null)
                                    @if (strlen($saida->observacoes) > $limite_texto)
                                        {{ substr($saida->observacoes, 0, $limite_texto) . '...' }}
                                    @else
                                        {{ $saida->observacoes }}
                                    @endif
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if ($saida->finalizada == 0)
                                    <span class="label label-default">Não</span>
                                @else
                                    <span class="label label-success">Sim</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('saidas.show', $saida->id) }}" class="btn btn-info" title="Visualizar"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('saidas.edit', $saida->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                @if($saidas->total() > 0)
                                    {!! Form::open(['id' => 'form_excluir_' . $saida->id, 'method' => 'delete', 'route' => ['saidas.destroy', $saida->id], 'style'=>'display: inline']) !!}
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
        {{ $saidas->render() }}
        <h6><b>{{ $saidas->total() }}</b> {{ $saidas->total() == 1 ? 'registro' : 'registros' }} no total</h6>
    </section>
@endsection

@if($saidas->total() > 0)
    @section('scripts')
        {!! Html::script('js/modal-excluir.js') !!}
    @endsection
@endif
