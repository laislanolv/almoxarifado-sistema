<?php

namespace Estoque\Http\Middleware;

use Closure;

class EntradaCheckLote {
    public function handle($request, Closure $next) {
        $lote = $request->entrada->produtos()
            ->wherePivot('id_entrada', $request->entrada->id)
            ->where('id_produto', $request->id_produto)
            ->where('numero_lote', $request->numero_lote)
            ->count();

        if ($lote == 1) {
            return redirect()->route('entradas.add-item.create', $request->entrada->id)->with('danger', 'Não é possível cadastrar o mesmo produto com o mesmo lote em uma entrada. O lote está correto?');
        }

        return $next($request);
    }
}
