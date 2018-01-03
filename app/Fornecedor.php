<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model {
    protected $table = 'fornecedores';

    public $timestamps = false;

    protected $fillable = [
        'id_cidade',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'email',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'telefone_1',
        'telefone_2',
        'observacoes',
        'status'
    ];

    public function cidade() {
        return $this->belongsTo('Estoque\Cidade', 'id_cidade');
    }
}
