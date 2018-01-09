<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {
    protected $table = 'produtos';

    public $timestamps = false;

    protected $fillable = [
        'id_marca',
        'id_categoria',
        'id_unidade_entrada',
        'id_unidade_saida',
        'proporcao',
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

    public function unidadeEntrada() {
        return $this->belongsTo('Estoque\UnidadeMedida', 'id_unidade_entrada');
    }

    public function unidadeSaida() {
        return $this->belongsTo('Estoque\UnidadeMedida', 'id_unidade_saida');
    }
}
