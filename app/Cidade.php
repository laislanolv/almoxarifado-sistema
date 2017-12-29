<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {
    protected $table = 'cidades';

    public function estado() {
        return $this->belongsTo('Estoque\Estado', 'id_estado');
    }
}
