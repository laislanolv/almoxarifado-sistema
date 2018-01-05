<?php

namespace Estoque\Http\Controllers;

use Estoque\Estado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CidadesController extends Controller {
    public function getCidades($estado) {
        $cidades = Estado::find($estado)->cidades;
        return Response::json($cidades);
    }
}
