<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <title>@yield('title', 'SGN')</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-4">
        <div class="container">

            <a class="navbar-brand" href="/">
                SGN
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal"
                aria-expanded="false"
                aria-label="Abrir menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">

                <div class="navbar-nav ms-auto">

                    <a class="nav-link" href="/">
                        Início
                    </a>

                    <a class="nav-link" href="/clientes">
                        Clientes
                    </a>

                    <a class="nav-link" href="{{ route('servicos.index') }}">
                        Serviços
                    </a>

                    <a class="nav-link" href="{{ route('contas.index') }}">
                        Contas a receber
                    </a>

                    <a class="nav-link" href="{{ route('relatorios.index') }}">
                        Relatórios
                    </a>

                </div>

            </div>

        </div>
    </nav>

    <main class="container pb-5">
        @yield('content')
    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>