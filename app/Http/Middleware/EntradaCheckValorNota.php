<?php

namespace Estoque\Http\Middleware;

use Closure;

class EntradaCheckValorNota {
    public function handle($request, Closure $next) {
        if ($request->entrada->valor_nota != $request->valor_total_nota) {
            return redirect()->route('entradas.add-item.create', $request->entrada->id)->with('danger', 'A soma total dos itens não é igual o valor total da nota, informada na etapa anterior.');
        } elseif ($request->entrada->quantidade_itens_nota != $request->quantidade_itens_nota) {
            return redirect()->route('entradas.add-item.create', $request->entrada->id)->with('danger', 'A quantidade de itens não é igual a quantidade informada na etapa anterior.');
        }
    
        return $next($request);
    }
}
