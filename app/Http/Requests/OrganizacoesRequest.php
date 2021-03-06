<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizacoesRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_cidade' => 'required|integer',
            'nome' => 'required|string|max:200'
        ];
    }

    public function messages() {
        return [
            'id_cidade.required' => 'O campo cidade é obrigatório.'
        ];
    }
}
