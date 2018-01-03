<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetoresRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_departamento' => 'required|integer',
            'nome' => 'required|string|max:200'
        ];
    }

    public function messages() {
        return [
            'id_departamento.required' => 'O campo departamento é obrigatório.'
        ];
    }
}
