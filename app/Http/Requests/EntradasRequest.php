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
            'id_departamento' => 'required|integer',
            'id_fornecedor' => 'required|integer',
            'id_fonte_recurso' => 'required|integer',
            'data' => 'required|string',
            'numero_nota' => 'required|string|max:200',
            'valor_nota' => 'required|regex:/^\d*(\.\d{1,4})?$/',
            'quantidade_itens_nota' => 'required|integer',
            'anexo_nota' => 'nullable|string',
            'observacoes' => 'nullable|string'
        ];
    }

    public function messages() {
        return [
            'id_usuario.required' => 'O campo usuário é obrigatório.',
            'id_departamento.required' => 'O campo departamento é obrigatório.',
            'id_fornecedor.required' => 'O campo fornecedor é obrigatório.',
            'id_fonte_recurso.required' => 'O campo fonte de recurso é obrigatório.',
            'numero_nota.required' => 'O campo número da nota é obrigatório.',
            'valor_nota.required' => 'O campo valor da nota é obrigatório.',
            'quantidade_itens_nota.required' => 'O campo quantidade de itens da nota é obrigatório.'
        ];
    }
}
