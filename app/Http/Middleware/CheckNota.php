<?php

namespace Estoque\Http\Middleware;

use Estoque\Entrada;
use Closure;

class CheckNota {
    public function handle($request, Closure $next) {
        if ($request->entrada->finalizada == 1) {
            return redirect()->route('entradas.index')->with('danger', 'A entrada já está finalizada e não é mais possível fazer qualquer alteração.');
        }

        return $next($request);
    }
}
