<div class="row">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step1" class="btn btn-primary btn-circle"><i class="fa fa-file-text-o"></i></a>
                <p>Cabeçalho da Nota</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step2" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-list-ol"></i></a>
                <p>Itens da Nota</p>
            </div>
        </div>
    </div>
    {!! Form::open(array('id' => 'form_entradas_step1', 'method' => 'post', 'route' => 'entradas.store')) !!}
        {!! Form::hidden('step', '1') !!}
        <div id="step1" class="row setup-content">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Usuário:</strong>
                    {!! Form::text(null, isset($entrada) ? $entrada->id_usuario : 'Laislan Oliveira', ['disabled' => 'disabled', 'class' => 'form-control']) !!}
                    {!! Form::hidden('id_usuario', isset($entrada) ? $entrada->id_usuario : '1') !!}
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
                    {!! Form::text(null, isset($entrada) ? number_format($entrada->valor_nota, 4, ',', '.') : null, ['id' => 'valor_nota', 'placeholder' => 'Valor da Nota', 'class' => 'form-control real']) !!}
                    {!! Form::hidden('valor_nota', '') !!}
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
                    {!! Form::file('anexo_nota', ['placeholder' => 'Anexo da Nota', 'class' => 'form-control file']) !!}
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
    {!! Form::close() !!}

    {!! Form::open(array('id' => 'form_entradas_step2', 'method' => 'post', 'route' => 'entradas.store')) !!}
        <div id="step2" class="row setup-content">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Produto:</strong>
                    {!! Form::select('produtos', [], null, ['placeholder' => 'Selecione o Produto', 'id' => 'produtos', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>Nome</th>
                        <th style="width: 100px;">Quantidade</th>
                        <th style="width: 125px;">Valor</th>
                        <th style="width: 125px;">Total</th>
                        <th style="width: 45px;"></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {!! Form::submit('Finalizar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#produtos').select2({
            placeholder: 'Selecione o Produto',
            minimumInputLength: 1,
            ajax: {
                url: '{{ url("produtos/find") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        produto: $.trim(params.term)
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(produto) {
                            return {
                                text: produto.nome + ' (' + produto.unidade_entrada.nome + ')',
                                id: produto.id
                            }
                        })
                    }
                },
                cache: true
            }
        });
    });
    
    $('#produtos').change(function(e) {
        var text = $('option:selected', this).text();
        var nome = '<td>' + text + '</td>';
        var quantidade = '<td><input type="number" name="produto_quantidade[]" class="form-control" style="width: 75px;"></td>';
        var preco = '<td><input type="text" name="produto_preco[]" class="form-control" style="width: 100px;"></td>';
        var total = '<td><input type="text" name="produto_total[]" class="form-control" style="width: 100px;" disabled="disabled"></td>';
        var acoes = '<td><i class="fa fa-trash" onclick="deleteRow(this)" style="font-size: 20px; color: #d61a1a; margin-top: 7px; cursor: pointer;"></i></td>';
        $('table tbody').append('<tr>' + nome + quantidade + preco + total + acoes +'</tr>');
    });

    function deleteRow(el) {
        $(el).fadeOut(1000, function() {
            $(this).closest('tr').remove();
        });
    }

    $('#form_entradas_step1, #form_entradas_step2').submit(function() {
        var valor_nota = $('#valor_nota').maskMoney('unmasked')[0];
        $('input[name=valor_nota]').val(valor_nota);
        $('input[name=valor_nota]').val() == '0' ? $('input[name=valor_nota]').val('') : $('input[name=valor_nota]').val();
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection
