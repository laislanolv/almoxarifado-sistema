<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaidasProdutosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'quantidade' => 'required|numeric|between:0.00001,99999999999.9999'
        ];
    }

    public function messages() {
        return [
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.between' => 'O quantidade é obrigatório.'
        ];
    }
}
