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

    public function setores() {
        return $this->hasMany('Estoque\Setor', 'id_departamento');
    }
    
    public function usuarios() {
        return $this->belongsToMany('Estoque\Usuario', 'usuarios_departamentos', 'id_departamento', 'id_usuario');
    }
}
