<div id="step3" class="row setup-content" style="margin-top: 20px;">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
        {!! Form::submit('Finalizar Entrada', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script>
    $('#form_entradas_step3').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection