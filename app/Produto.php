<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {
    protected $table = 'produtos';

    public $timestamps = false;

    protected $fillable = [
        'id_marca',
        'id_categoria',
        'id_unidade_medida',
        'nome',
        'descricao',
        'altura',
        'largura',
        'peso',
        'status'
    ];

    public function marca() {
        return $this->belongsTo('Estoque\Marca', 'id_marca');
    }

    public function categoria() {
        return $this->belongsTo('Estoque\Categoria', 'id_categoria');
    }

    public function unidade() {
        return $this->belongsTo('Estoque\UnidadeMedida', 'id_unidade_medida');
    }
}
