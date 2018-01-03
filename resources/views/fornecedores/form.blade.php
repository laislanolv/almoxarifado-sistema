<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estado:</strong>
            {!! Form::select('estado', $estados, isset($fornecedor) ? $fornecedor->cidade->estado->id : null, ['placeholder' => 'Selecione o Estado', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cidade:</strong>
            {!! Form::select('id_cidade', [], null, ['placeholder' => 'Selecione a Cidade', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CNPJ:</strong>
            {!! Form::text('cnpj', isset($fornecedor) ? $fornecedor->cnpj : null, ['placeholder' => 'CNPJ', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Razão Social:</strong>
            {!! Form::text('razao_social', isset($fornecedor) ? $fornecedor->razao_social : null, ['placeholder' => 'Razão Social', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Fantasia:</strong>
            {!! Form::text('nome_fantasia', isset($fornecedor) ? $fornecedor->nome_fantasia : null, ['placeholder' => 'Nome Fantasia', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {!! Form::email('email', isset($fornecedor) ? $fornecedor->email : null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>CEP:</strong>
            {!! Form::text('cep', isset($fornecedor) ? $fornecedor->cep : null, ['placeholder' => 'CEP', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Logradouro:</strong>
            {!! Form::text('logradouro', isset($fornecedor) ? $fornecedor->logradouro : null, ['placeholder' => 'Logradouro', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Número:</strong>
            {!! Form::number('numero', isset($fornecedor) ? $fornecedor->numero : null, ['placeholder' => 'Número', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Complemento:</strong>
            {!! Form::text('complemento', isset($fornecedor) ? $fornecedor->complemento : null, ['placeholder' => 'Complemento', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone 1:</strong>
            {!! Form::tel('telefone_1', isset($fornecedor) ? $fornecedor->telefone_1 : null, ['placeholder' => 'Telefone 1', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Telefone 2:</strong>
            {!! Form::tel('telefone_2', isset($fornecedor) ? $fornecedor->telefone_2 : null, ['placeholder' => 'Telefone 2', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Observações:</strong>
            {!! Form::textarea('observacoes', isset($fornecedor) ? $fornecedor->observacoes : null, ['placeholder' => 'Observações', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
@if (!isset($fornecedor))
    <script>
        $(document).ready(function() {
            $('select[name=estado] option:eq(0)').prop('selected', true);
            $('select[name=id_cidade]').prop('disabled', true);
            $('select[name=id_cidade] option:eq(0)').prop('selected', true);
        });
    </script>
@endif
<script>
    function getCidades(id_estado) {
        $('select[name=id_cidade]').prop('disabled', true);
        $('select[name=id_cidade]').empty();
        $('select[name=id_cidade]').append('<option value="">Carregando...</option>');
        
        setTimeout(function() {
            $.get('/cidades/' + id_estado, function(cidades) {
                $('select[name=id_cidade]').empty();
                $('select[name=id_cidade]').append('<option value="">Selecione a Cidade</option>');

                $.each(cidades, function(key, value) {
                    $('select[name=id_cidade]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });

                $('select[name=id_cidade]').prop('disabled', false);
            });
        }, 1000);
    }

    $('select[name=estado]').change(function() {
        var id_estado = $(this).val();
        
        if (id_estado != '') {
            getCidades(id_estado);
        } else {
            $('select[name=id_cidade]').empty();
            $('select[name=id_cidade]').append('<option value="">Selecione a Cidade</option>');
            $('select[name=id_cidade]').prop('disabled', true);
        }
    });

    $('#form_fornecedores').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@if (isset($fornecedor))
    <script>
        var id_estado = $('select[name=estado]').val();
        getCidades(id_estado);

        var ajaxComplete = 0;

        $(document).ajaxComplete(function() {
            if (ajaxComplete === 0) {
                $('select[name=id_cidade]').val(<?php echo $fornecedor->id_cidade; ?>);
                ajaxComplete = 1;
            }
        });
    </script>
@endif
@endsection
