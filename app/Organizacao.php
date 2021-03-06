<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Organizacao extends Model {
    protected $table = 'organizacoes';

    public $timestamps = false;

    protected $fillable = [
        'id_cidade',
        'nome',
        'observacoes',
        'status'
    ];

    public function cidade() {
        return $this->belongsTo('Estoque\Cidade', 'id_cidade');
    }
}
