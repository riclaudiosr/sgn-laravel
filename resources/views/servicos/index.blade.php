@extends('layouts.app')

@section('title', 'Serviços - SGN')

@section('content')

<div class="container">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">Serviços</h2>

            <p class="text-muted mb-0">
                Cadastre e acompanhe os serviços realizados para seus clientes.
            </p>
        </div>

        <a href="{{ route('servicos.create') }}" class="btn btn-primary">
            + Novo serviço
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

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <strong>Serviços cadastrados</strong>

                <span class="badge bg-primary">
                    {{ $servicos->count() }}
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
                            <th>Data</th>
                            <th>Situação</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($servicos as $servico)

                            <tr>

                                <td class="ps-4">
                                    {{ $servico->id }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $servico->cliente->nome ?? 'Cliente não encontrado' }}
                                </td>

                                <td>
                                    {{ $servico->descricao }}
                                </td>

                                <td>
                                    R$ {{ number_format($servico->valor, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($servico->data_servico)->format('d/m/Y') }}
                                </td>

                                <td>

                                    @if($servico->situacao === 'Concluído')

                                        <span class="badge bg-success">
                                            {{ $servico->situacao }}
                                        </span>

                                    @elseif($servico->situacao === 'Pendente')

                                        <span class="badge bg-warning text-dark">
                                            {{ $servico->situacao }}
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $servico->situacao }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($servico->ativo)

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
                                        href="{{ route('servicos.edit', $servico) }}"
                                        class="btn btn-outline-primary btn-sm me-1">
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('servicos.toggle', $servico) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm {{ $servico->ativo ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                            onclick="return confirm('Deseja {{ $servico->ativo ? 'desativar' : 'reativar' }} este serviço?')">

                                            {{ $servico->ativo ? 'Desativar' : 'Reativar' }}

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-5">

                                    Nenhum serviço cadastrado.

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