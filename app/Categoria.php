<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    protected $table = 'categorias';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
