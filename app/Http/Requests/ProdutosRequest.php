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
            'id_unidade_entrada' => 'required|integer',
            'id_unidade_saida' => 'required|integer',
            'proporcao' => 'nullable|integer',
            'nome' => 'required|string|max:200|unique:produtos,nome',
            'descricao' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'largura' => 'nullable|numeric',
            'peso' => 'nullable|numeric'
        ];
    }

    public function messages() {
        return [
            'id_marca.required' => 'O campo marca é obrigatório.',
            'id_categoria.required' => 'O campo categoria é obrigatório.',
            'id_unidade_entrada.required' => 'O campo unidade de medida de entrada é obrigatório.',
            'id_unidade_saida.required' => 'O campo unidade de medida de saída é obrigatório.'
        ];
    }
}
