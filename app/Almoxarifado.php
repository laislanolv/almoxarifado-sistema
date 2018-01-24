<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Almoxarifado extends Model {
    protected $table = 'almoxarifados';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
