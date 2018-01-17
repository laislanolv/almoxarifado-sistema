<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradasProdutosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_produto' => 'required|integer',
            'numero_lote' => 'nullable|string|max:200',
            'vencimento_lote' => 'nullable|string',
            'quantidade' => 'required'
        ];
    }

    public function messages() {
        return [
            'id_produto.required' => 'O campo produto é obrigatório.',
            'numero_lote.max' => 'O campo número do lote não pode ser superior a 200 caracteres.',
            'quantidade.required' => 'O campo quantidade é obrigatório.'
        ];
    }
}
