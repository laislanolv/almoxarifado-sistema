<?php

namespace Estoque\Http\Controllers\Api;

use Estoque\Departamento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Estoque\Http\Controllers\Controller;

class SetoresController extends Controller {
    public function __invoke(Departamento $departamento) {
        $setores = $departamento->setores()->get();
        return Response::json($setores, 200);
    }
}
