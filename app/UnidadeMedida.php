<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class UnidadeMedida extends Model {
    protected $table = 'unidade_medidas';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
