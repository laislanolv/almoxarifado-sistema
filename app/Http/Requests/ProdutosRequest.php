<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_marca' => 'required|integer',
            'id_categoria' => 'required|integer',
            'id_unidade_medida' => 'required|integer',
            'nome' => 'required|string|max:200',
            'altura' => 'nullable|numeric|between:0,99.99',
            'largura' => 'nullable|numeric|between:0,99.99',
            'peso' => 'nullable|numeric|between:0,99.99'
        ];
    }

    public function messages() {
        return [
            'id_marca.required' => 'O campo marca é obrigatório.',
            'id_categoria.required' => 'O campo categoria é obrigatório.',
            'id_unidade_medida.required' => 'O campo unidade de medida é obrigatório.'
        ];
    }
}
