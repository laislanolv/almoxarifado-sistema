<?php

namespace Estoque\Http\Middleware;

use Closure;

class EntradaCheckItens {
    public function handle($request, Closure $next) {
        if ($request->entrada->produtos->count() == 0) {
            return redirect()->route('entradas.add-item.create', $request->entrada->id)->with('danger', 'Uma entrada não pode ser finalizar vazia.');
        }

        return $next($request);
    }
}
