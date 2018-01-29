<?php

namespace Estoque;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model {
    protected $table = 'saidas';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_almoxarifado',
        'id_setor',
        'id_fonte_recurso',
        'data',
        'observacoes',
        'status'
    ];

    public static function formatData($data) {
        return Carbon::createFromFormat('d/m/Y', $data)->toDateString();
    }

    public function setor() {
        return $this->belongsTo('Estoque\Setor', 'id_setor');
    }

    public function produtos() {
        return $this->belongsToMany('Estoque\Produto', 'saidas_produtos', 'id_saida', 'id_produto')->withPivot('id', 'id_produto', 'id_entrada_produto', 'quantidade')->orderBy('saidas_produtos.id', 'asc');
    }
}
