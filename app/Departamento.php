<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model {
    protected $table = 'departamentos';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
