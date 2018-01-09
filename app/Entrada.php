<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model {
    protected $table = 'entradas';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_departamento',
        'id_fornecedor',
        'id_fonte_recurso',
        'data',
        'numero_nota',
        'valor_nota',
        'quantidade_itens_nota',
        'anexo_nota',
        'observacoes',
        'finalizada',
        'status'
    ];
}
