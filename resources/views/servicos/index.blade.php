@extends('layouts.app')

@section('title', 'Serviços - SGN')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Serviços</h2>
            <p class="mb-0">
                Cadastre e acompanhe os serviços realizados para seus clientes.
            </p>
        </div>

        <a href="{{ route('servicos.create') }}" class="btn btn-primary">
            Novo serviço
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
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
                            <th>Data</th>
                            <th>Situação</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servicos as $servico)
                        <tr>
                            <td>{{ $servico->id }}</td>
                            <td>
                                {{ $servico->cliente->nome ?? 'Cliente não encontrado' }}
                            </td>
                            <td>{{ $servico->descricao }}</td>
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
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                                    <a
                                        href="{{ route('servicos.edit', $servico) }}"
                                        class="btn btn-warning btn-sm">
                                        Editar
                                    </a>
                                    <form
                                        action="{{ route('servicos.toggle', $servico) }}"
                                        method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            type="submit"
                                            class="btn btn-secondary btn-sm w-100">
                                            {{ $servico->ativo ? 'Desativar' : 'Reativar' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
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