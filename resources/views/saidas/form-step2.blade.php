<div id="step2" class="row setup-content">
    {!! Form::open(array('id' => 'form_saidas_step2', 'method' => 'post', 'route' => ['saidas.add-item.store', $saida->id])) !!}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Produto:</strong>
                    {!! Form::select('id_entrada_produto', [], null, ['id' => 'produtos', 'class' => 'form-control', 'style' => 'width: 100%;', 'required' => 'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Quantidade:</strong>
                    {!! Form::text('quantidade', null, ['id' => 'quantidade', 'maxlength' => '15', 'class' => 'form-control quantidade', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9">
                {!! Form::button('Adicionar Produto <i class="fa fa-check"></i>', ['type' => 'button', 'id' => 'btn-submit-step2', 'class' => 'btn btn-default', 'style' => 'margin-top: 20px;']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
        <table class="table table-striped table-hover">
            <thead>
                <th>Nome</th>
                <th class="text-right">Quantidade</th>
                <th class="text-right">Valor</th>
                <th class="text-right">Total</th>
                <th style="width: 45px;"></th>
            </thead>
            <tbody>
                @foreach ($itens as $item)
                    <tr>
                        <td>{{ $item->nome }}</td>
                        <td class="text-right"><span class="quantidade-inserida">{{ $item->pivot->quantidade }}</span</td>
                        <td class="text-right"><span class="valor-unitario">{{ $item->pivot->valor_unitario }}</span></td>
                        <td class="text-right"><span class="valor-total-item"></span></td>
                        <td>
                            {!! Form::open(['id' => 'form_excluir_' . $item->pivot->id, 'method' => 'delete', 'route' => ['saidas.del-item.destroy', $saida->id], 'style'=>'display: inline']) !!}
                            {!! Form::hidden('id_produto', $item->pivot->id_produto) !!}
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
            var valor_total_item = $(this).text().replace('.', '').replace(',', '.').replace('R$ ', '');
            var valor_total_nota = soma;
            soma = parseFloat(valor_total_item) + parseFloat(valor_total_nota);
            numero_total_itens++;
        });
        
        $('.valor-total-nota').text(soma.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ "));
        $('input[name=valor_total_nota]').val(soma);
        $('.numero-total-itens').text(numero_total_itens);
        $('input[name=quantidade_itens_nota]').val(numero_total_itens);

        var label_valor_nota = parseFloat('{{$saida->valor_nota}}');
        $('.label-valor-nota').text('Valor Total: ' + label_valor_nota.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL', minimumFractionDigits: 4 }).replace("R$", "R$ "));
        
        var label_quantidade_itens = parseInt('{{$saida->quantidade_itens_nota}}');
        $('.label-quantidade-itens').text('Quantidade de Itens: ' + label_quantidade_itens + ' itens');

        $('#produtos').select2({
            placeholder: 'Nº da Nota | Data da Entrada | Produto | Unidade de Medida | Nº do Lote | Vencimento do Lote | Estoque',
            minimumInputLength: 1,
            ajax: {
                url: '{{ route("api.produtos.saida.find") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nome_produto: $.trim(params.term),
                        almoxarifado: '{{$saida->id_almoxarifado}}',
                        fonte_recurso: '{{$saida->id_fonte_recurso}}',
                        data_saida: '{{$saida->data}}'
                    }
                },
                processResults: function(data) {
                    console.log(data);
                    
                    return {
                        results: $.map(data, function(produto) {
                            return {
                                text: produto.numero_nota + ' | ' +
                                    produto.data_entrada + ' | ' + 
                                    produto.nome_produto + ' | ' +
                                    produto.unidade_medida + ' | ' +
                                    produto.numero_lote + ' | ' +
                                    produto.vencimento_lote + ' | ' +
                                    produto.quantidade,
                                id: produto.id_entrada_produto
                            }
                        })
                    }
                },
                cache: true
            }
        });

        $('#form_saidas_step2').validate({
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
        $(this).prop('disabled', true).html('Aguarde um pouco...');

        if ($('#form_saidas_step2').valid()) {
            $('input[name=valor_unitario]').val($('#valor_unitario').maskMoney('unmasked')[0]);
            $('input[name=quantidade]').val($('#quantidade').maskMoney('unmasked')[0]);
            $('#form_saidas_step2').submit();
        } else {
            $(this).prop('disabled', false).html('Adicionar Produto <i class="fa fa-check"></i>');
        }
    });

    $('#btn_form_saidas_end').click(function(e) {
        e.preventDefault();
        var form = $(this).parent();
        form.find('button').prop('disabled', true);

        swal({
            title: 'Finalizar Entrada',
            text: 'Atenção! Você está prestes a finalizar esta saida. Tem certeza?', 
            icon: 'warning',
            buttons: true,
            buttons: ['Cancelar', 'Sim. Finalizar']
        }).then((willFinalize) => {
            if (willFinalize) {
                swal('Aguarde... a saida está sendo finalizada!', {
                    title: 'Pronto!',
                    icon: 'success',
                    buttons: false
                });

                setTimeout(function() {
                    form.submit();
                }, 2000);
            } else {
                swal('Entrada não finalizada!', {
                    title: 'Cancelado!',
                    icon: 'success',
                });

                form.find('button').prop('disabled', false);
            }
        });
    });
</script>

{!! Html::script('js/modal-excluir.js') !!}

@endsection
