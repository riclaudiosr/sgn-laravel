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

<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm mb-4">
        <div class="container">

            <a class="navbar-brand fw-bold" href="/">
                SGN
                <small class="d-block fw-normal text-secondary" style="font-size: 11px;">
                    Sistema de Gestão de Negócios
                </small>
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

                    <a class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }}"
                       href="/">
                        Início
                    </a>

                    <a class="nav-link {{ request()->is('clientes*') ? 'active fw-semibold' : '' }}"
                       href="/clientes">
                        Clientes
                    </a>

                    <a class="nav-link {{ request()->is('servicos*') ? 'active fw-semibold' : '' }}"
                       href="{{ route('servicos.index') }}">
                        Serviços
                    </a>

                    <a class="nav-link {{ request()->is('contas*') ? 'active fw-semibold' : '' }}"
                       href="{{ route('contas.index') }}">
                        Contas a receber
                    </a>

                    <a class="nav-link {{ request()->is('relatorios*') ? 'active fw-semibold' : '' }}"
                       href="{{ route('relatorios.index') }}">
                        Relatórios
                    </a>

                </div>

            </div>

        </div>
    </nav>

    <main class="container pb-5 flex-grow-1">
        @yield('content')
    </main>

    <footer class="border-top bg-white py-3 mt-auto">
        <div class="container text-center text-muted small">
            SGN — Sistema de Gestão de Negócios
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>