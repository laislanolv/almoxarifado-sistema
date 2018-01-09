<?php

namespace Estoque;

use Illuminate\Database\Eloquent\Model;

class FonteRecurso extends Model {
    protected $table = 'fontes_recursos';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status'
    ];
}
