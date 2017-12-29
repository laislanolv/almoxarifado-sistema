<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nome' => 'required|max:200'
        ];
    }
}
