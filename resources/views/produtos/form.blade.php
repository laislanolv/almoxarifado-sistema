<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Fornecedor:</strong>
            {!! Form::select('id_fornecedor', $fornecedores, isset($produto) ? $produto->id_fornecedor : null, ['placeholder' => 'Selecione o Fornecedor', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Marca:</strong>
            {!! Form::select('id_marca', $marcas, isset($produto) ? $produto->id_marca : null, ['placeholder' => 'Selecione a Marca', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Categoria:</strong>
            {!! Form::select('id_categoria', $categorias, isset($produto) ? $produto->id_categoria : null, ['placeholder' => 'Selecione a Categoria', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Unidade de Medida:</strong>
            {!! Form::select('id_unidade_medida', $unidades, isset($produto) ? $produto->id_unidade_medida : null, ['placeholder' => 'Selecione a Unidade', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', isset($produto) ? $produto->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Descrição:</strong>
            {!! Form::textarea('descricao', isset($produto) ? $produto->descricao : null, ['placeholder' => 'Descrição', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Altura:</strong>
            {!! Form::number('altura', isset($produto) ? $produto->altura : null, ['placeholder' => 'Altura', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Largura:</strong>
            {!! Form::number('largura', isset($produto) ? $produto->largura : null, ['placeholder' => 'Largura', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Peso:</strong>
            {!! Form::number('peso', isset($produto) ? $produto->peso : null, ['placeholder' => 'Peso', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script>
    $('#form_produtos').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection
