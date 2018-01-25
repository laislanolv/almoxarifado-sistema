<?php

namespace Estoque\Http\Controllers;

use Estoque\Estado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CidadesController extends Controller {
    public function __invoke(Estado $estado) {
        $cidades = $estado->cidades()->get();
        return Response::json($cidades);
    }
}
