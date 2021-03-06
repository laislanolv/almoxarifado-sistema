<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradasRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_usuario' => 'required|integer',
            'id_almoxarifado' => 'required|integer',
            'id_fornecedor' => 'required|integer',
            'id_fonte_recurso' => 'required|integer',
            'data' => 'required|string',
            'numero_nota' => 'required|string|max:200',
            'valor_nota' => 'required|numeric|between:0.00001,99999999999.9999',
            'quantidade_itens_nota' => 'required|integer',
            'anexo_nota' => 'nullable|mimes:jpeg,jpg,png,docx,doc,pdf|max:10240',
            'observacoes' => 'nullable|string'
        ];
    }

    public function messages() {
        return [
            'id_usuario.required' => 'O campo usuário é obrigatório.',
            'id_almoxarifado.required' => 'O campo almoxarifado é obrigatório.',
            'id_fornecedor.required' => 'O campo fornecedor é obrigatório.',
            'id_fonte_recurso.required' => 'O campo fonte de recurso é obrigatório.',
            'numero_nota.required' => 'O campo número da nota é obrigatório.',
            'valor_nota.required' => 'O campo valor da nota é obrigatório.',
            'valor_nota.between' => 'O campo valor da nota é obrigatório..',
            'quantidade_itens_nota.required' => 'O campo quantidade de itens da nota é obrigatório.'
        ];
    }
}
