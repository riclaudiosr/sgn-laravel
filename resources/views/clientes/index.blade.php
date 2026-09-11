@extends('layouts.app')

@section('title', 'Clientes - SGN')

@section('content')

<div class="container">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">Clientes</h2>

            <p class="text-muted mb-0">
                Gerencie os clientes cadastrados no sistema.
            </p>
        </div>

        <a href="/clientes/novo" class="btn btn-primary">
            + Novo cliente
        </a>

    </div>

    @if (session('sucesso'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        {{ session('sucesso') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Fechar">
        </button>

    </div>
    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <strong>Clientes cadastrados</strong>

                <span class="badge bg-primary">
                    {{ $clientes->count() }}
                </span>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="ps-4">Nome</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($clientes as $cliente)

                        <tr>

                            <td class="ps-4 fw-semibold">
                                {{ $cliente->nome }}
                            </td>

                            <td>
                                {{ $cliente->email }}
                            </td>

                            <td>

                                @if ($cliente->ativo)

                                <span class="badge bg-success">
                                    Ativo
                                </span>

                                @else

                                <span class="badge bg-secondary">
                                    Inativo
                                </span>

                                @endif

                            </td>

                            <td class="text-end pe-4">

                                <a
                                    href="/clientes/{{ $cliente->id }}/editar"
                                    class="btn btn-outline-primary btn-sm me-1">
                                    Editar
                                </a>

                                <form
                                    action="{{ route('clientes.toggle', $cliente) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm {{ $cliente->ativo ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                        onclick="return confirm('Deseja {{ $cliente->ativo ? 'desativar' : 'reativar' }} este cliente?')">

                                        {{ $cliente->ativo ? 'Desativar' : 'Reativar' }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center text-muted py-5">

                                Nenhum cliente cadastrado.

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