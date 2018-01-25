<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaidasRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'id_usuario' => 'required|integer',
            'id_almoxarifado' => 'required|integer',
            'id_setor' => 'required|integer',
            'id_fonte_recurso' => 'required|integer',
            'data' => 'required|string',
            'observacoes' => 'nullable|string'
        ];
    }

    public function messages() {
        return [
            'id_usuario.required' => 'O campo usuário é obrigatório.',
            'id_almoxarifado.required' => 'O campo almoxarifado é obrigatório.',
            'id_setor.required' => 'O campo setor é obrigatório.',
            'id_fonte_recurso.required' => 'O campo fonte de recurso é obrigatório.'
        ];
    }
}
