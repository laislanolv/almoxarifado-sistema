<?php

namespace Estoque\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FontesRecursosRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nome' => 'required|string|max:200'
        ];
    }
}
