@extends('layouts.app')

@section('title', 'Contas a receber - SGN')

@section('content')

<div class="container">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">Contas a receber</h2>

            <p class="text-muted mb-0">
                Controle suas cobranças, vencimentos e pagamentos.
            </p>
        </div>

        <a href="{{ route('contas.create') }}" class="btn btn-primary">
            + Nova conta
        </a>

    </div>

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Fechar">
        </button>

    </div>

    @endif

    <div class="row g-3 mb-4">

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
                        Contas pendentes
                    </h6>

                    <h3 class="fw-bold mb-0">
                        {{ $quantidadePendente }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('contas.index') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-md-4">

                        <label for="status" class="form-label fw-semibold">
                            Filtrar por status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select">

                            <option value="">
                                Todos
                            </option>

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

                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Filtrar

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a
                            href="{{ route('contas.index') }}"
                            class="btn btn-outline-secondary w-100">

                            Limpar

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <strong>Contas cadastradas</strong>

                <span class="badge bg-primary">
                    {{ $contas->count() }}
                </span>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Cliente</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Pagamento</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($contas as $conta)

                        <tr>

                            <td class="ps-4">
                                {{ $conta->id }}
                            </td>

                            <td class="fw-semibold">
                                {{ $conta->cliente->nome ?? 'Cliente não encontrado' }}
                            </td>

                            <td>
                                {{ $conta->descricao }}
                            </td>

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

                                <span class="text-muted">
                                    -
                                </span>

                                @endif

                            </td>

                            <td class="text-end pe-4">

                                <a
                                    href="{{ route('contas.edit', $conta) }}"
                                    class="btn btn-outline-primary btn-sm me-1">

                                    Editar

                                </a>

                                <form
                                    action="{{ route('contas.toggle', $conta) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm {{ $conta->ativo ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                        onclick="return confirm('Deseja {{ $conta->ativo ? 'desativar' : 'reativar' }} esta conta?')">

                                        {{ $conta->ativo ? 'Desativar' : 'Reativar' }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted py-5">

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