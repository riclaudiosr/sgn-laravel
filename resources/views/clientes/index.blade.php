@extends('layouts.app')

@section('title', 'Clientes - SGN')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Clientes</h2>
            <p class="mb-0">Lista de clientes do Sistema de Gestão de Negócios.</p>
        </div>

        <a href="/clientes/novo" class="btn btn-primary">
            Novo cliente
        </a>
    </div>

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($clientes as $cliente)

                            <tr>
                                <td>{{ $cliente->nome }}</td>

                                <td>{{ $cliente->email }}</td>

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

                                <td class="text-end">

                                    <a
                                        href="/clientes/{{ $cliente->id }}/editar"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="/clientes/{{ $cliente->id }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
                                        >
                                            Excluir
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted">
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