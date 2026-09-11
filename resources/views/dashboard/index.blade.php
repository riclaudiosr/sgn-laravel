@extends('layouts.app')

@section('title', 'Dashboard - SGN')

@section('content')

<div class="container">

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard</h2>

        <p class="text-muted mb-0">
            Visão geral do Sistema de Gestão de Negócios.
        </p>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        Clientes ativos
                    </h6>

                    <h3 class="fw-bold mb-0">
                        {{ $clientesAtivos }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        Serviços ativos
                    </h6>

                    <h3 class="fw-bold mb-0">
                        {{ $servicosAtivos }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        A receber
                    </h6>

                    <h3 class="fw-bold text-warning mb-0">
                        R$ {{ number_format($totalPendente, 2, ',', '.') }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        Recebido
                    </h6>

                    <h3 class="fw-bold text-success mb-0">
                        R$ {{ number_format($totalPago, 2, ',', '.') }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        Vencido
                    </h6>

                    <h3 class="fw-bold text-danger mb-0">
                        R$ {{ number_format($totalVencido, 2, ',', '.') }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="text-muted mb-2">
                        Total de clientes
                    </h6>

                    <h3 class="fw-bold mb-0">
                        {{ $totalClientes }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <strong>Últimos clientes cadastrados</strong>

                <a href="/clientes" class="btn btn-outline-primary btn-sm">
                    Ver clientes
                </a>

            </div>

        </div>

        <div class="card-body p-0">

            @if ($ultimosClientes->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-4">Nome</th>
                                <th>E-mail</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($ultimosClientes as $cliente)

                                <tr>

                                    <td class="ps-4 fw-semibold">
                                        {{ $cliente->nome }}
                                    </td>

                                    <td>
                                        {{ $cliente->email }}
                                    </td>

                                    <td>

                                        @if($cliente->ativo)

                                            <span class="badge bg-success">
                                                Ativo
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inativo
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center text-muted py-5">
                    Nenhum cliente cadastrado.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection