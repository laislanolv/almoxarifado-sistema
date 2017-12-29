<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
    protected $table = 'marcas';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
