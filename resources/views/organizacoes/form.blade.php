<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estado:</strong>
            {!! Form::select('estado', $estados, null, ['placeholder' => 'Estados', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Cidade:</strong>
            {!! Form::select('id_cidade', [], null, ['placeholder' => 'Cidades', 'class' => 'form-control', 'disabled']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', isset($organizacao) ? $organizacao->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Observações:</strong>
            {!! Form::textarea('observacoes', isset($organizacao) ? $organizacao->observacoes : null, ['placeholder' => 'Observações', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('select[name=estado] option:eq(0)').prop('selected', true);
        $('select[name=id_cidade]').prop('disabled', true);
        $('select[name=id_cidade] option:eq(0)').prop('selected', true);
    });

    $('select[name=estado]').change(function() {
        var id_estado = $(this).val();
        
        if (id_estado != '') {
            $.get('/cidades/' + id_estado, function(cidades) {
                $('select[name=id_cidade]').empty();
                $('select[name=id_cidade]').append('<option value="">Cidades</option>');

                $.each(cidades, function(key, value) {
                    $('select[name=id_cidade]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });

                $('select[name=id_cidade]').prop('disabled', false);
            });
        } else {
            $('select[name=id_cidade]').empty();
            $('select[name=id_cidade]').append('<option value="">Cidades</option>');
            $('select[name=id_cidade]').prop('disabled', true);
        }
    });

    $('#form_organizacoes').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection
