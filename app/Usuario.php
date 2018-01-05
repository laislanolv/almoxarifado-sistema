<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $fillable = [
        'id_tipo',
        'id_organizacao',
        'nome',
        'email',
        'senha',
        'status'
    ];

    public static function encryptSenha($senha) {
        return md5($senha);
    }

    public function tipo() {
        return $this->belongsTo('Estoque\UsuarioTipo', 'id_tipo');
    }

    public function organizacao() {
        return $this->belongsTo('Estoque\Organizacao', 'id_organizacao');
    }

    public function departamentos() {
        return $this->belongsToMany('Estoque\Departamento', 'usuarios_departamentos', 'id_usuario', 'id_departamento');
    }
}
