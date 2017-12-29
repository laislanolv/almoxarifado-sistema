<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model {
    protected $table = 'usuarios_tipos';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
