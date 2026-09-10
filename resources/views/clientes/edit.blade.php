@extends('layouts.app')

@section('title', 'Editar Cliente - SGN')

@section('content')

    <h2>Editar Cliente</h2>

    <p>Altere os dados do cliente.</p>

    @if ($errors->any())
        <div>
            <strong>Corrija os erros abaixo:</strong>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/clientes/{{ $cliente->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nome:</label><br>
            <input
                type="text"
                name="nome"
                value="{{ old('nome', $cliente->nome) }}"
            >
        </div>

        <br>

        <div>
            <label>E-mail:</label><br>
            <input
                type="email"
                name="email"
                value="{{ old('email', $cliente->email) }}"
            >
        </div>

        <br>

        <div>
            <label>Telefone:</label><br>
            <input
                type="text"
                name="telefone"
                value="{{ old('telefone', $cliente->telefone) }}"
            >
        </div>

        <br>

        <button type="submit">
            Salvar alterações
        </button>
    </form>

    <br>

    <a href="/clientes">Voltar para clientes</a>

@endsection