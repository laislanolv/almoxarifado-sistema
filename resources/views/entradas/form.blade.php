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
    {!! Form::open(array('id' => 'form_entradas_step1', 'method' => 'post', 'files' => true, 'route' => 'entradas.store')) !!}
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
                    @if(!isset($entrada->anexo_nota))
                        {!! Form::file('anexo_nota', ['placeholder' => 'Anexo da Nota', 'class' => 'form-control file']) !!}
                    @else
                        <br><a href='{{ asset("uploads/notas/$entrada->anexo_nota") }}' target="_blank"><i class="fa fa-file-text-o"></i> <b>Abir Nota Fiscal anexada</b></a> <b>/</b> <a href="#" class="text-danger">(deletar o anexo)</a>
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
    {!! Form::close() !!}

    <div id="step2" class="row setup-content">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Produto:</strong>
                    {!! Form::select('produtos', [], null, ['placeholder' => 'Selecione o Produto', 'id' => 'produtos', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Quantidade:</strong>
                    {!! Form::text('quantidade', null, ['id' => 'quantidade', 'maxlength' => '15', 'class' => 'form-control quantidade']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Valor:</strong>
                    {!! Form::text('valor', null, ['id' => 'valor', 'maxlength' => '21', 'class' => 'form-control real']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 text-center">
                <div class="form-group">
                    {!! Form::button('Adicionar <i class="fa fa-check"></i>', ['id' => 'add_item', 'class' => 'btn btn-default', 'style' => 'margin-top: 20px;']) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Nome</th>
                    <th style="width: 200px;">Quantidade</th>
                    <th style="width: 200px;">Valor</th>
                    <th style="width: 200px;">Total</th>
                    <th style="width: 45px;"></th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        {!! Form::open(array('id' => 'form_entradas_step2', 'method' => 'post', 'route' => 'entradas.store')) !!}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {!! Form::submit('Finalizar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
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
    
    $('#add_item').click(function() {
        var self = $(this);

        self.prop('disabled', true).text('Aguarde...');

        var produtos = $('#produtos');

        var produto_selecionado = $('#produtos option:selected');
        var quantidade = $('#quantidade');
        var valor = $('#valor');

        var valor_total = quantidade.maskMoney('unmasked')[0] * valor.maskMoney('unmasked')[0];

        var td_produto = '<td>' + produto_selecionado.text() + '</td>';
        var td_quantidade = '<td>' + quantidade.val() + '</td>';
        var td_valor = '<td>' + valor.val() + '</td>';
        var td_total = '<td>' + valor_total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ ") + '</td>';
        var td_acoes = '<td><i class="fa fa-trash text-danger" onclick="deleteRow(this)" style="font-size: 20px; cursor: pointer;"></i></td>';
        
        setTimeout(function() {
            $('table tbody').append('<tr>' + td_produto + td_quantidade + td_valor + td_total + td_acoes +'</tr>');

            produtos.val('').trigger('change');
            quantidade.val('0,0000');
            valor.val('0,0000');
            
            self.prop('disabled', false).html('Adicionar <i class="fa fa-check"></i>');
        }, 3000);
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
