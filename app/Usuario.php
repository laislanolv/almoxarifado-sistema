<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $fillable = [
        'id_tipo',
        'id_organizacao',
        'id_departamento',
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

    public function departamento() {
        return $this->belongsTo('Estoque\Departamento', 'id_departamento');
    }
}
