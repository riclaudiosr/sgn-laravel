@extends('layouts.app')

@section('title', 'Novo Cliente - SGN')

@section('content')

    <h2>Novo Cliente</h2>

    <p>Cadastro de cliente do Sistema de Gestão de Negócios.</p>

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

    <form action="/clientes" method="POST">
        @csrf

        <div>
            <label>Nome:</label><br>
            <input type="text" name="nome" value="{{ old('nome') }}">
        </div>

        <br>

        <div>
            <label>E-mail:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <br>

        <div>
            <label>Telefone:</label><br>
            <input type="text" name="telefone" value="{{ old('telefone') }}">
        </div>

        <br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>

    <a href="/clientes">Voltar para clientes</a>

@endsection