<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de Estoque</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 3px;
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="m-b-md">
                    <img src="img/logo.png" alt="Logo">
                </div>

                <div class="title m-b-md">
                    Sistema de Estoque
                </div>

                <div class="links">
                    <a href="{{ route('tipos-usuarios.index') }}">Tipos de Usuários</a>
                    <a href="{{ route('usuarios.index') }}">Usuários</a>
                    <a href="{{ route('fontes-recursos.index') }}">Fontes de Recursos</a>
                    <a href="{{ route('almoxarifados.index') }}">Almoxarifados</a>
                    <a href="{{ route('departamentos.index') }}">Departamentos</a>
                    <a href="{{ route('setores.index') }}">Setores</a>
                    <a href="{{ route('marcas.index') }}">Marcas</a>
                    <a href="{{ route('unidades.index') }}">Unidades</a>
                    <a href="{{ route('categorias.index') }}">Categorias</a>
                    <a href="{{ route('produtos.index') }}">Produtos</a>
                    <a href="{{ route('entradas.index') }}">Entradas</a>
                    <a href="{{ route('saidas.index') }}">Saídas</a>
                    <a href="{{ route('fornecedores.index') }}">Fornecedores</a>
                    <a href="{{ route('organizacoes.index') }}">Organizações</a>
                </div>
            </div>
        </div>
    </body>
</html>
