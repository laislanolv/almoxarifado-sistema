<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model {
    protected $table = 'setores';

    public $timestamps = false;

    protected $fillable = [
        'id_departamento',
        'nome',
        'status'
    ];

    public function departamento() {
        return $this->belongsTo('Estoque\Departamento', 'id_departamento');
    }
}
