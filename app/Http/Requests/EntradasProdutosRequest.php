<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradasProdutosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'numero_lote' => 'nullable|string|max:200',
            'vencimento_lote' => 'nullable|string',
            'quantidade' => 'required|numeric|between:0.00001,99999999999.9999',
            'valor_unitario' => 'required|numeric|between:0.00001,99999999999.9999'
        ];
    }

    public function messages() {
        return [
            'numero_lote.max' => 'O campo número do lote não pode ser superior a 200 caracteres.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.between' => 'O quantidade é obrigatório.',
            'valor_unitario.required' => 'O campo valor unitário é obrigatório.',
            'valor_unitario.between' => 'O campo valor unitário é obrigatório.',
        ];
    }
}
