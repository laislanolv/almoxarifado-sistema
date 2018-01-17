<?php

namespace Estoque;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class EntradaProduto extends Model {
    protected $table = 'entradas_produtos';

    public $timestamps = false;

    protected $fillable = [
        'id_entrada',
        'id_produto',
        'numero_lote',
        'vencimento_lote',
        'quantidade',
        'valor_unitario'
    ];

    public static function formatData($data) {
        return Carbon::createFromFormat('d/m/Y', $data)->toDateString();
    }
}
