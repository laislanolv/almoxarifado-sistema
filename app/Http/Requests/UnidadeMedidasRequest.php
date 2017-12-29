<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeMedidasRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nome' => 'required|max:200'
        ];
    }
}
