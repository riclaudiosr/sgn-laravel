@extends('layouts.app')

@section('title', 'Dashboard - SGN')

@section('content')

<div class="container">

    <h2>Dashboard</h2>
    <p class="mb-4">Visão geral do Sistema de Gestão de Negócios.</p>

    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Clientes ativos</h6>
                    <h3>{{ $clientesAtivos }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Serviços ativos</h6>
                    <h3>{{ $servicosAtivos }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-warning">
                <div class="card-body">
                    <h6 class="text-warning">A receber</h6>
                    <h3>
                        R$ {{ number_format($totalPendente, 2, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-success">
                <div class="card-body">
                    <h6 class="text-success">Recebido</h6>
                    <h3>
                        R$ {{ number_format($totalPago, 2, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-danger">
                <div class="card-body">
                    <h6 class="text-danger">Vencido</h6>
                    <h3>
                        R$ {{ number_format($totalVencido, 2, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total de clientes</h6>
                    <h3>{{ $totalClientes }}</h3>
                </div>
            </div>
        </div>

    </div>

    <h3 class="mb-3">Últimos clientes cadastrados</h3>

    @if ($ultimosClientes->count() > 0)

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($ultimosClientes as $cliente)

                                <tr>
                                    <td>{{ $cliente->nome }}</td>

                                    <td>{{ $cliente->email }}</td>

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

            </div>
        </div>

    @else

        <div class="alert alert-info">
            Nenhum cliente cadastrado.
        </div>

    @endif

</div>

@endsection