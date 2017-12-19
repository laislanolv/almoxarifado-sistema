<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model {
    protected $table = 'cidades';

    public function estados() {
        return $this->belongsTo('App\Estado');
    }

    public function bairros() {
        return $this->hasMany('App\Bairro', 'id_cidade');
    }
}
