<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FornecedoresRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'id_cidade' => 'required|integer',
            'razao_social' => 'required|string|max:200',
            'nome_fantasia' => 'required|string|max:200',
            'cep' => 'required|string|max:8',
            'logradouro' => 'required|string|max:200',
            'numero' => 'nullable|string|max:20',
            'complemento' => 'nullable|string|max:100',
            'telefone_1' => 'required|string|max:14',
            'telefone_2' => 'nullable|string|max:14'
        ];

        if ($this->method() == 'POST') {
            $rules['cnpj'] = 'required|string|max:14|unique:fornecedores,cnpj';
            $rules['email'] = 'required|email|max:100|unique:fornecedores,email';
        } else {
            $rules['cnpj'] = [
                'required',
                'string',
                'max:14',
                Rule::unique('fornecedores')->ignore($this->fornecedor->id)
            ];
            $rules['email'] = [
                'required',
                'email',
                'max:100',
                Rule::unique('fornecedores')->ignore($this->fornecedor->id)
            ];
        }

        return $rules;
    }

    public function messages() {
        return [
            'id_cidade.required' => 'O campo cidade é obrigatório.',
            'razao_social.required' => 'O campo razão social é obrigatório.',
            'razao_social.max' => 'O campo razão social não pode ser superior a 200 caracteres.',
            'numero.max' => 'O campo número não pode ser superior a 20 caracteres.'
        ];
    }
}
