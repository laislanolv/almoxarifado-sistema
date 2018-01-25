<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Estoque - @yield('title')</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet">
        <link href="{{ asset('/libs/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/stepwizard.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/swal.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/pt-BR.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('/libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <script src="{{ asset('/libs/jquery-maskmoney/dist/jquery.maskMoney.min.js') }}"></script>
        <script src="{{ asset('/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    </head>
    <body>
        <header>
            <nav class="navbar">
                <div class="container-fluid">
                    <section class="navbar-header">
                        <a href="/" class="navbar-brand">Início</a>
                        <a href="{{ route('usuarios.index') }}" class="navbar-brand">Usuários</a>
                        <a href="{{ route('fontes-recursos.index') }}" class="navbar-brand">Fontes de Recursos</a>
                        <a href="{{ route('almoxarifados.index') }}" class="navbar-brand">Almoxarifados</a>
                        <a href="{{ route('departamentos.index') }}" class="navbar-brand">Departamentos</a>
                        <a href="{{ route('setores.index') }}" class="navbar-brand">Setores</a>
                        <a href="{{ route('marcas.index') }}" class="navbar-brand">Marcas</a>
                        <a href="{{ route('unidades.index') }}" class="navbar-brand">Unidades</a>
                        <a href="{{ route('categorias.index') }}" class="navbar-brand">Categorias</a>
                        <a href="{{ route('produtos.index') }}" class="navbar-brand">Produtos</a>
                        <a href="{{ route('entradas.index') }}" class="navbar-brand">Entradas</a>
                        <a href="{{ route('saidas.index') }}" class="navbar-brand">Saídas</a>
                        <a href="{{ route('fornecedores.index') }}" class="navbar-brand">Fornecedores</a>
                        <a href="{{ route('organizacoes.index') }}" class="navbar-brand">Organizações</a>
                    </section>
                </div>
            </nav>
        </header>

        <main class="container" style="margin-bottom: 20px;">
            @yield('content')
        </main>

        <script>
            $(document).ready(function() {
                $.fn.select2.defaults.set('theme', 'bootstrap');
                $.fn.select2.defaults.set('language', 'pt-BR');
                $('select').select2();

                $('input.data').datepicker({
                    format: "dd/mm/yyyy",
                    language: "pt-BR",
                    autoclose: true,
                    todayHighlight: true
                });

                $('input.real').maskMoney({
                    prefix: 'R$ ',
                    thousands: '.',
                    decimal: ',',
                    precision: 4,
                    selectAllOnFocus: true,
                }).trigger('mask.maskMoney');

                $('input.quantidade').maskMoney({
                    prefix: '',
                    thousands: '',
                    decimal: ',',
                    precision: 4,
                    selectAllOnFocus: true,
                }).trigger('mask.maskMoney');
            });
        </script>

        @yield('scripts')
        
    </body>
</html>
