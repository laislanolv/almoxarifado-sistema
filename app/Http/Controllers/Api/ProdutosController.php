<?php

namespace Estoque\Http\Controllers\Api;

use Estoque\Produto;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Estoque\Http\Controllers\Controller;

class ProdutosController extends Controller {
    public function getProdutosEntrada(Request $request) {
        $termo = $request->produto;

        if (empty($termo)) {
            return Response::json([], 200);
        }

        $produtos = Produto::with('unidadeEntrada')->with('entradas')->orderBy('nome', 'asc')->where('nome', 'like', "%$termo%")->get();
        return Response::json($produtos, 200);
    }

    public function getProdutosSaida(Request $request) {
        $nome_produto = $request->nome_produto;
        $almoxarifado = $request->almoxarifado;
        $fonte_recurso = $request->fonte_recurso;
        $data_saida = $request->data_saida;

        $produtos = DB::table('entradas_produtos as enp')
            ->select('enp.id as id_entrada_produto', 'ent.numero_nota', 'ent.data as data_entrada', 'pro.nome as nome_produto', 'unm.nome as unidade_medida', 'enp.numero_lote', 'enp.vencimento_lote')
            ->join('entradas as ent', 'enp.id_entrada', '=', 'ent.id')
            ->join('produtos as pro', 'enp.id_produto', '=', 'pro.id')
            ->join('unidade_medidas as unm', 'pro.id_unidade_entrada', '=', 'unm.id')
            ->where('ent.id_almoxarifado', '=', $almoxarifado)
            ->where('ent.id_fonte_recurso', '=', $fonte_recurso)
            ->where('ent.finalizada', '=', '1')
            ->where('pro.nome', 'like', "%$nome_produto%")
            ->whereDate('ent.data', '<=', $data_saida)
            ->get();

        foreach($produtos as $produto) {
            if (!$produto->numero_lote) {
                $produto->numero_lote = 'Sem Lote';
                $produto->vencimento_lote = 'Sem Lote';
            } else {
                $produto->vencimento_lote = Carbon::parse($produto->vencimento_lote)->format('d/m/Y');
            }

            $produto->data_entrada = Carbon::parse($produto->data_entrada)->format('d/m/Y');
            $produto->quantidade = $this->getEstoque($produto->id_entrada_produto);
        }

        return Response::json($produtos, 200);
    }

    private function getEstoque($id_produto_entrada) {
        $quantidade_entrada = DB::table('entradas_produtos as enp')->select('enp.quantidade')->where('id', '=', $id_produto_entrada)->first();

        $quantide_saida = DB::table('saidas_produtos as sap')
            ->select('sap.quantidade')
            ->join('saidas as sai', 'sap.id_saida', '=', 'sai.id')
            ->where('sap.id_entrada_produto', '=', $id_produto_entrada)
            ->where('sai.finalizada', '=', '1')
            ->sum('sap.quantidade');

        return (float)($quantidade_entrada->quantidade - (float)$quantide_saida);
    }
}
