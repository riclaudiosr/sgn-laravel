@extends('layouts.app')

@section('title', 'Novo Cliente - SGN')

@section('content')

<div class="container">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Novo cliente
        </h2>

        <p class="text-muted mb-0">
            Cadastre um novo cliente no Sistema de Gestão de Negócios.
        </p>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Corrija os erros abaixo:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $erro)

                            <li>
                                {{ $erro }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="/clientes" method="POST">

                @csrf

                <div class="mb-3">

                    <label for="nome" class="form-label fw-semibold">
                        Nome
                    </label>

                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome') }}"
                        placeholder="Digite o nome do cliente">

                    @error('nome')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label for="email" class="form-label fw-semibold">
                        E-mail
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="exemplo@email.com">

                    @error('email')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="mb-4">

                    <label for="telefone" class="form-label fw-semibold">
                        Telefone
                    </label>

                    <input
                        type="text"
                        name="telefone"
                        id="telefone"
                        class="form-control @error('telefone') is-invalid @enderror"
                        value="{{ old('telefone') }}"
                        placeholder="(11) 99999-9999">

                    @error('telefone')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="d-flex flex-column flex-sm-row gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Cadastrar cliente

                    </button>

                    <a
                        href="/clientes"
                        class="btn btn-outline-secondary">

                        Voltar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection