<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {
    protected $table = 'estados';

    public function cidades() {
        return $this->hasMany('Estoque\Cidade', 'id_estado');
    }
}
