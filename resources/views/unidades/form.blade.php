<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', isset($unidade) ? $unidade->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script>
    $('#form_unidades').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection
