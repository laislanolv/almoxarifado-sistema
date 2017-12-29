<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Estoque - @yield('title')</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar">
                <div class="container-fluid">
                    <section class="navbar-header">
                        <a href="/" class="navbar-brand">Início</a>
                        <a href="{{ route('departamentos.index') }}" class="navbar-brand">Departamentos</a>
                        <a href="{{ route('marcas.index') }}" class="navbar-brand">Marcas</a>
                        <a href="{{ route('unidades.index') }}" class="navbar-brand">Unidades</a>
                        <a href="{{ route('categorias.index') }}" class="navbar-brand">Categorias</a>
                        <a href="{{ route('produtos.index') }}" class="navbar-brand">Produtos</a>
                        <a href="{{ route('organizacoes.index') }}" class="navbar-brand">Organizações</a>
                    </section>
                </div>
            </nav>
        </header>

        <main class="container" style="margin-bottom: 20px;">
          @yield('content')
        </main>

        @yield('scripts')
        
    </body>
</html>
