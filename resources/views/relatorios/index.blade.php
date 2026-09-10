@extends('layouts.app')

@section('title', 'Relatórios - SGN')

@section('content')

<div class="container">

    <div class="mb-4">
        <h2>Relatórios</h2>
        <p class="mb-0">
            Resumo financeiro por período e situação das cobranças.
        </p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('relatorios.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label for="data_inicial" class="form-label">
                            Data inicial
                        </label>

                        <input
                            type="date"
                            name="data_inicial"
                            id="data_inicial"
                            class="form-control"
                            value="{{ request('data_inicial') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="data_final" class="form-label">
                            Data final
                        </label>

                        <input
                            type="date"
                            name="data_final"
                            id="data_final"
                            class="form-control"
                            value="{{ request('data_final') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select name="status" id="status" class="form-select">

                            <option value="">Todos</option>

                            <option
                                value="Pendente"
                                {{ request('status') == 'Pendente' ? 'selected' : '' }}>
                                Pendente
                            </option>

                            <option
                                value="Pago"
                                {{ request('status') == 'Pago' ? 'selected' : '' }}>
                                Pago
                            </option>

                            <option
                                value="Cancelado"
                                {{ request('status') == 'Cancelado' ? 'selected' : '' }}>
                                Cancelado
                            </option>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            Filtrar
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-warning">
                <div class="card-body">

                    <h6 class="text-warning">
                        Total pendente
                    </h6>

                    <h3>
                        R$ {{ number_format($totalPendente, 2, ',', '.') }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100 border-success">
                <div class="card-body">

                    <h6 class="text-success">
                        Total recebido
                    </h6>

                    <h3>
                        R$ {{ number_format($totalPago, 2, ',', '.') }}
                    </h3>

                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($contas as $conta)

                        <tr>

                            <td>{{ $conta->id }}</td>

                            <td>
                                {{ $conta->cliente->nome ?? 'Cliente não encontrado' }}
                            </td>

                            <td>{{ $conta->descricao }}</td>

                            <td>
                                R$ {{ number_format($conta->valor, 2, ',', '.') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}
                            </td>

                            <td>

                                @if($conta->status === 'Pago')

                                <span class="badge bg-success">
                                    Pago
                                </span>

                                @elseif($conta->status === 'Pendente')

                                <span class="badge bg-warning text-dark">
                                    Pendente
                                </span>

                                @elseif($conta->status === 'Cancelado')

                                <span class="badge bg-secondary">
                                    Cancelado
                                </span>

                                @endif

                            </td>

                            <td>
                                @if($conta->data_pagamento)

                                {{ \Carbon\Carbon::parse($conta->data_pagamento)->format('d/m/Y') }}

                                @else

                                -

                                @endif
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Nenhum registro encontrado para os filtros selecionados.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection