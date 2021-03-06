<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estado:</strong>
            {!! Form::select('estado', $estados, isset($organizacao) ? $organizacao->cidade->estado->id : null, ['placeholder' => 'Selecione o Estado', 'class' => 'form-control']) !!}
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
@if (!isset($organizacao))
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
            $.get('/api/' + id_estado + '/cidades/', function(cidades) {
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

    $('#form_organizacoes').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@if (isset($organizacao))
    <script>
        var id_estado = $('select[name=estado]').val();
        getCidades(id_estado);

        var ajaxComplete = 0;

        $(document).ajaxComplete(function() {
            if (ajaxComplete === 0) {
                $('select[name=id_cidade]').val(<?php echo $organizacao->id_cidade; ?>);
                ajaxComplete = 1;
            }
        });
    </script>
@endif
@endsection
