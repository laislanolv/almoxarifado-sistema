<div class="row">
    <div id="step1" class="row setup-content" style="margin-top: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usuário:</strong>
                {!! Form::text(null, isset($entrada) ? $entrada->id_usuario : 'Laislan Oliveira', ['disabled' => 'disabled', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Departamento:</strong>
                {!! Form::select('id_departamento', $departamentos, isset($entrada) ? $entrada->id_departamento : null, ['placeholder' => 'Selecione o Departamento', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fornecedor:</strong>
                {!! Form::select('id_fornecedor', $fornecedores, isset($entrada) ? $entrada->id_fornecedor : null, ['placeholder' => 'Selecione o Fornecedor', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fonte de Recurso:</strong>
                {!! Form::select('id_fonte_recurso', $fontes_recursos, isset($entrada) ? $entrada->id_fonte_recurso : null, ['placeholder' => 'Selecione a Fonte de Recurso', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Data:</strong>
                {!! Form::text('data', isset($entrada) ? \Carbon\Carbon::parse($entrada->data)->format('d/m/Y') : null, ['placeholder' => 'Data', 'class' => 'form-control data']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Número da Nota:</strong>
                {!! Form::text('numero_nota', isset($entrada) ? $entrada->numero_nota : null, ['placeholder' => 'Número da Nota', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Valor da Nota:</strong>
                {!! Form::text('valor_nota', isset($entrada) ? number_format($entrada->valor_nota, 4, ',', '.') : null, ['id' => 'valor_nota', 'placeholder' => 'Valor da Nota', 'class' => 'form-control real']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantidade de itens da Nota:</strong>
                {!! Form::text('quantidade_itens_nota', isset($entrada) ? $entrada->quantidade_itens_nota : null, ['placeholder' => 'Quantidade de itens da Nota', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Anexo da Nota:</strong>
                @if(!isset($entrada->anexo_nota))
                    {!! Form::file('anexo_nota', ['placeholder' => 'Anexo da Nota', 'class' => 'form-control file']) !!}
                @else
                    <br>
                    <a href="{{ asset('uploads/notas/$entrada->anexo_nota') }}" target="_blank"><i class="fa fa-file-text-o"></i> <b>Abir Nota Fiscal anexada</b></a>
                    <b>/</b>
                    <a href="#" id="deletar_nota" class="text-danger">(deletar o anexo)</a>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observações:</strong>
                {!! Form::textarea('observacoes', isset($entrada) ? $entrada->observacoes : null, ['placeholder' => 'Observações', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>

@section('scripts')
@if (!isset($entrada))
    <script>
        $(document).ready(function() {
            $('#valor_nota').val('');
        });
    </script>
@endif
@if (isset($entrada))
    <script>
        $('#deletar_nota').click(function(e) {
            e.preventDefault();
    
            swal({
                title: 'Tem certeza?',
                text: 'Atenção! Esta ação não pode ser desfeita.', 
                icon: 'warning',
                buttons: true,
                buttons: ['Cancelar', 'Deletar'],
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    swal('Aguarde... o anexo está sendo deletado!', {
                        title: 'Pronto!',
                        icon: 'success',
                        buttons: false
                    });
    
                    setTimeout(function() {
                        $.ajax({
                            url: '{{ route("entradas.del-attachment.destroy", $entrada->id) }}',
                            type: 'post',
                            data: {
                                _token: $('input[name=_token]').val(),
                                _method: 'patch'
                            },
                            success: function() {
                                window.location.href = '{{ route("entradas.edit", $entrada->id) }}';
                            }
                        });
                    }, 2000);
                } else {
                    swal('Anexo não deletado!', {
                        title: 'Cancelado!',
                        icon: 'success',
                    });
                }
            });
        });
    </script>
@endif
<script>
    $('#form_entradas_step1').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
        $('input[name=valor_nota]').val($('#valor_nota').maskMoney('unmasked')[0]);
    });
</script>
@endsection
