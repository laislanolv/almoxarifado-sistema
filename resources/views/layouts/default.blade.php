<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NFSe - @yield('title')</title>
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
                        <a href="#" class="navbar-brand">NFS-e</a>
                        <a href="/pessoas-fisicas" class="navbar-brand">Pessoas Físicas</a>
                        <a href="/pessoas-juridicas" class="navbar-brand">Pessoas Jurídicas</a>
                    </section>
                </div>
            </nav>
        </header>

        <main class="container">
          @yield('content')
        </main>

        @yield('scripts')
        
    </body>
</html>
