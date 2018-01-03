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

            .title-moderar {
                font-size: 34px;
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
                <div class="title">
                    Sistema de Estoque
                </div>

                <div class="title-moderar m-b-md">
                    Moderar TI
                </div>

                <div class="links">
                    <a href="{{ route('usuarios.index') }}">Usuários</a>
                    <a href="{{ route('departamentos.index') }}">Departamentos</a>
                    <a href="{{ route('marcas.index') }}">Marcas</a>
                    <a href="{{ route('unidades.index') }}">Unidades</a>
                    <a href="{{ route('categorias.index') }}">Categorias</a>
                    <a href="{{ route('produtos.index') }}">Produtos</a>
                    <a href="{{ route('organizacoes.index') }}">Organizações</a>
                </div>
            </div>
        </div>
    </body>
</html>
