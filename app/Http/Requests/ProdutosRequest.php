<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_marca' => 'required',
            'id_categoria' => 'required',
            'id_unidade_medida' => 'required',
            'nome' => 'required|max:200'
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
