<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class UsuarioDepartamento extends Model {
    protected $table = 'usuarios_departamentos';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_departamento'
    ];
}
