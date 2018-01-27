<?php

namespace Estoque;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model {
    protected $table = 'entradas';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_almoxarifado',
        'id_fornecedor',
        'id_fonte_recurso',
        'data',
        'numero_nota',
        'valor_nota',
        'quantidade_itens_nota',
        'anexo_nota',
        'observacoes',
        'finalizada',
        'status'
    ];

    public static function formatData($data) {
        return Carbon::createFromFormat('d/m/Y', $data)->toDateString();
    }

    public static function uploadNota($anexo) {
        $nome = md5(time().uniqid(rand(), true)) . '.' . $anexo->getClientOriginalExtension();
        $anexo->move(public_path('uploads/notas'), $nome);
        return $nome;
    }

    public static function deleteNota($anexo) {
        $delete = unlink(public_path('uploads/notas/' . $anexo));
        return $delete;
    }

    public function produtos() {
        return $this->belongsToMany('Estoque\Produto', 'entradas_produtos', 'id_entrada', 'id_produto')->withPivot('id', 'numero_lote', 'vencimento_lote', 'quantidade', 'valor_unitario')->orderBy('entradas_produtos.id', 'asc');
    }
}
