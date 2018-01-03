<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuariosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'id_tipo' => 'required|integer',
            'id_organizacao' => 'required|integer',
            'id_departamento' => 'required|integer',
            'nome' => 'required|string|max:200'
        ];

        if ($this->method() == 'POST') {
            $rules['email'] = 'required|email|max:200|unique:usuarios,email';
            $rules['senha'] = 'required|min:6|max:255|confirmed';
            $rules['senha_confirmation'] = 'required|min:6|max:255';
        } else {
            $rules['email'] = [
                'required',
                'email',
                'max:200',
                Rule::unique('usuarios')->ignore($this->usuario->id)
            ];
            $rules['senha'] = 'nullable|min:6|max:255|confirmed';
            $rules['senha_confirmation'] = 'nullable|min:6|max:255';
        }

        return $rules;
    }

    public function messages() {
        return [
            'id_tipo.required' => 'O campo tipo é obrigatório.',
            'id_organizacao.required' => 'O campo organização é obrigatório.',
            'id_departamento.required' => 'O campo departamento de medida é obrigatório.',
            'senha.confirmed' => 'O campo confirmar senha não confere.',
            'senha_confirmation.required' => 'O campo confirmar senha é obrigatório.',
            'senha_confirmation.min' => 'O campo confirmar senha deve ter pelo menos 6 caracteres.',
            'senha_confirmation.max' => 'O campo confirmar senha não pode ser superior a 255 caracteres.'
        ];
    }
}
