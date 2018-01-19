<div id="step2" class="row setup-content" style="margin-top: 20px;">
    {!! Form::open(array('id' => 'form_entradas_step2', 'method' => 'post', 'route' => ['entradas.add-item.store', $entrada->id])) !!}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Produto:</strong>
                    {!! Form::select('id_produto', [], null, ['placeholder' => 'Selecione o Produto', 'id' => 'produtos', 'class' => 'form-control', 'style' => 'width: 100%;', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Número do Lote:</strong>
                    {!! Form::text('numero_lote', null, ['id' => 'numero_lote', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Vencimento do Lote:</strong>
                    {!! Form::text('vencimento_lote', null, ['id' => 'vencimento_lote', 'class' => 'form-control data']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Quantidade:</strong>
                    {!! Form::text('quantidade', null, ['id' => 'quantidade', 'maxlength' => '15', 'class' => 'form-control quantidade', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="form-group">
                    <strong>Valor:</strong>
                    {!! Form::text('valor_unitario', null, ['id' => 'valor_unitario', 'maxlength' => '21', 'class' => 'form-control real', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 text-center">
                {!! Form::button('Adicionar <i class="fa fa-check"></i>', ['type' => 'button', 'id' => 'btn-submit-step2', 'class' => 'btn btn-default', 'style' => 'margin-top: 20px;']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <table class="table table-striped table-hover">
            <thead>
                <th>Nome</th>
                <th>Número do Lote</th>
                <th>Vencimento do Lote</th>
                <th class="text-right">Quantidade</th>
                <th class="text-right">Valor</th>
                <th class="text-right">Total</th>
                <th style="width: 45px;"></th>
            </thead>
            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->pivot->numero_lote ? $item->pivot->numero_lote : '--'}}</td>
                        <td>{{ $item->pivot->vencimento_lote ? \Carbon\Carbon::parse($item->pivot->vencimento_lote)->format('d/m/Y') : '--' }}</td>
                        <td class="text-right"><span class="quantidade-inserida">{{ $item->pivot->quantidade }}</span</td>
                        <td class="text-right"><span class="valor-unitario">{{ $item->pivot->valor_unitario }}</span></td>
                        <td class="text-right"><span class="valor-total-item"></span></td>
                        <td>
                            {!! Form::open(['id' => 'form_excluir_' . $item->pivot->id, 'method' => 'delete', 'route' => ['entradas.del-item.destroy', $entrada->id], 'style'=>'display: inline']) !!}
                            {!! Form::hidden('id_item', $item->pivot->id) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger modal-excluir', 'style' => 'padding: 1px 6px;']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                    <tr style="background-color: #ddd">
                        <td class="text-left"><b>Total de <span class="numero-total-itens"></span> itens</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><b><span class="valor-total-nota"></span></b></td>
                        <td></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#quantidade, #valor_unitario').val('');
        
        $('.quantidade-inserida').each(function() {
            var text = parseFloat($(this).text()).toFixed(4);
            $(this).text(text.replace('.', ','));
        });

        $('.valor-unitario').each(function() {
            var text = parseFloat($(this).text());
            $(this).text(text.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ "));
        });

        $('.valor-total-item').each(function(i) {
            var quantidade = $('.quantidade-inserida').eq(i).text().replace(',', '.');
            var valor_unitario = $('.valor-unitario').eq(i).text().replace(',', '.').replace('R$ ', '');
            var valor_total_item = parseFloat(quantidade) * parseFloat(valor_unitario);
            $(this).text(valor_total_item.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ "));
        });

        var soma = 0;
        var numero_total_itens = 0;

        $('.valor-total-item').each(function(i) {
            var valor_total_item = $(this).text().replace('.', '').replace(',', '').replace('R$ ', '');
            var valor_total_nota = soma;
            soma = eval(valor_total_item) + eval(valor_total_nota);
            numero_total_itens++;
        });

        soma = soma.toString();
        len = soma.length;
        soma_formatada = soma.substring(0, len - 4) + '.' + soma.substring(len - 4);
        soma_formatada = parseFloat(soma_formatada);
        
        $('.valor-total-nota').text(soma_formatada.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ "));
        $('.numero-total-itens').text(numero_total_itens);
        
        $('#produtos').select2({
            placeholder: 'Selecione o Produto',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route("produtos.find") }}',
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

        $('#form_entradas_step2').validate({
            rules: {
                produtos: 'required',
                quantidade: {
                    required: true,
                    maxlength: 15
                },
                valor_unitario: {
                    required: true,
                    maxlength: 21
                }
            },
            messages: {
                produtos: 'Campo obrigatório',
                quantidade: {
                    required: 'Campo obrigatório',
                    maxlength: 'Limite de 15 caracteres'
                },
                valor_unitario: {
                    required: 'Campo obrigatório',
                    maxlength: 'Limite de 21 caracteres'
                }
            },
            errorElement: 'em',
            errorPlacement: function(error, element) {
                error.addClass('help-block');
                
                // if (element.prop('type') === 'checkbox') {
                    // error.insertAfter(element.parent('label'));
                // } else {
                    // error.insertAfter(element);
                // }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.col-xs-2').addClass('has-error').removeClass('has-success');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.col-xs-2').removeClass('has-error');
                // $(element).parents('.col-xs-2').addClass('has-success').removeClass('has-error');
            }
        });
    });

    $('select').on('select2:close', function (e) {
        $(this).valid(); 
    });

    $('#btn-submit-step2').click(function(e) {
        $(this).prop('disabled', true).html('Aguarde...');

        if ($('#form_entradas_step2').valid()) {
            $('input[name=valor_unitario]').val($('#valor_unitario').maskMoney('unmasked')[0]);
            $('input[name=quantidade]').val($('#quantidade').maskMoney('unmasked')[0]);
            $('#form_entradas_step2').submit();
        } else {
            $(this).prop('disabled', false).html('Adicionar <i class="fa fa-check"></i>');
        }
    });
</script>

<script src="{{ asset('/js/modal-excluir.js') }}"></script>
@endsection
