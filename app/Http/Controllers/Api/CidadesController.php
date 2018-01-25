<?php

namespace Estoque\Http\Controllers\Api;

use Estoque\Estado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Estoque\Http\Controllers\Controller;

class CidadesController extends Controller {
    public function __invoke(Estado $estado) {
        $cidades = $estado->cidades()->get();
        return Response::json($cidades, 200);
    }
}
