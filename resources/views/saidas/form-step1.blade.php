<div class="row">
    <div id="step1" class="row setup-content">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usuário:</strong>
                {!! Form::text(null, 'Laislan Oliveira', ['disabled' => 'disabled', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Almoxarifado:</strong>
                {!! Form::select('id_almoxarifado', $almoxarifados, isset($saida) ? $saida->id_almoxarifado : null, ['placeholder' => 'Selecione o Almoxarifado', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departamento:</strong>
                {!! Form::select('departamento', $departamentos, isset($saida) ? $saida->setor->departamento->id : null, ['placeholder' => 'Selecione o Departamento', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Setor:</strong>
                {!! Form::select('id_setor', [], null, ['placeholder' => 'Selecione o Setor', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fonte de Recurso:</strong>
                {!! Form::select('id_fonte_recurso', $fontes_recursos, isset($saida) ? $saida->id_fonte_recurso : null, ['placeholder' => 'Selecione a Fonte de Recurso', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Data:</strong>
                {!! Form::text('data', isset($saida) ? \Carbon\Carbon::parse($saida->data)->format('d/m/Y') : null, ['placeholder' => 'Data', 'class' => 'form-control data']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observações:</strong>
                {!! Form::textarea('observacoes', isset($saida) ? $saida->observacoes : null, ['placeholder' => 'Observações', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>

@section('scripts')
@if (!isset($saida))
    <script>
        $(document).ready(function() {
            $('select[name=departamento] option:eq(0)').prop('selected', true);
            $('select[name=id_setor]').prop('disabled', true);
            $('select[name=id_setor] option:eq(0)').prop('selected', true);
        });
    </script>
@endif
<script>
    function getSetores(id_departamento) {
        $('select[name=id_setor]').prop('disabled', true);
        $('select[name=id_setor]').empty();
        $('select[name=id_setor]').append('<option value="">Carregando...</option>');
        
        setTimeout(function() {
            $.get('/api/' + id_departamento + '/setores/', function(setores) {
                $('select[name=id_setor]').empty();
                $('select[name=id_setor]').append('<option value="">Selecione o Setor</option>');

                $.each(setores, function(key, value) {
                    $('select[name=id_setor]').append('<option value=' + value.id + '>' + value.nome + '</option>');
                });

                $('select[name=id_setor]').prop('disabled', false);
            });
        }, 1000);
    }

    $('select[name=departamento]').change(function() {
        var id_departamento = $(this).val();
        
        if (id_departamento != '') {
            getSetores(id_departamento);
        } else {
            $('select[name=id_setor]').empty();
            $('select[name=id_setor]').append('<option value="">Selecione o Setor</option>');
            $('select[name=id_setor]').prop('disabled', true);
        }
    });

    $('#form_saidas_step1').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@if (isset($saida))
    <script>
        var id_departamento = $('select[name=departamento]').val();
        getSetores(id_departamento);

        var ajaxComplete = 0;

        $(document).ajaxComplete(function() {
            if (ajaxComplete === 0) {
                $('select[name=id_setor]').val(<?php echo $saida->id_setor; ?>);
                ajaxComplete = 1;
            }
        });
    </script>
@endif
@endsection
