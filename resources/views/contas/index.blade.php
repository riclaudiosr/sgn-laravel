@extends('layouts.app')

@section('title', 'Contas a receber - SGN')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Contas a receber</h2>
            <p class="mb-0">
                Controle suas cobranças, vencimentos e pagamentos.
            </p>
        </div>

        <a href="{{ route('contas.create') }}" class="btn btn-primary">
            Nova conta
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-3 mb-4">

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
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Contas pendentes</h6>
                    <h3>{{ $quantidadePendente }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('contas.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            Filtrar por status
                        </label>
                        <select
                            name="status"
                            id="status"
                            class="form-select"
                        >
                            <option value="">Todos</option>

                            <option
                                value="Pendente"
                                {{ request('status') == 'Pendente' ? 'selected' : '' }}
                            >
                                Pendente
                            </option>
                            <option
                                value="Pago"
                                {{ request('status') == 'Pago' ? 'selected' : '' }}
                            >
                                Pago
                            </option>
                            <option
                                value="Cancelado"
                                {{ request('status') == 'Cancelado' ? 'selected' : '' }}
                            >
                                Cancelado
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>
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
                            <th class="text-end">Ações</th>
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
                                <td>
                                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                                        <a
                                            href="{{ route('contas.edit', $conta) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Editar
                                        </a>
                                        <form
                                            action="{{ route('contas.toggle', $conta) }}"
                                            method="POST"
                                            class="m-0"
                                        >
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                type="submit"
                                                class="btn btn-secondary btn-sm w-100 text-nowrap"
                                            >
                                                {{ $conta->ativo ? 'Desativar' : 'Reativar' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Nenhuma conta cadastrada.
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