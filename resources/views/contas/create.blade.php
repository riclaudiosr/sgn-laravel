@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova conta</h1>

    <p>Cadastre uma nova cobrança para um cliente.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente_id">Cliente</label>

            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Selecione um cliente</option>

                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descricao">Descrição</label>

            <input
                type="text"
                name="descricao"
                id="descricao"
                class="form-control"
                value="{{ old('descricao') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="valor">Valor</label>

            <input
                type="number"
                name="valor"
                id="valor"
                class="form-control"
                step="0.01"
                min="0"
                value="{{ old('valor') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="data_vencimento">Data de vencimento</label>

            <input
                type="date"
                name="data_vencimento"
                id="data_vencimento"
                class="form-control"
                value="{{ old('data_vencimento') }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="status">Status</label>

            <select name="status" id="status" class="form-control" required>
                <option value="Pendente">Pendente</option>
                <option value="Pago">Pago</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_pagamento">Data de pagamento</label>

            <input
                type="date"
                name="data_pagamento"
                id="data_pagamento"
                class="form-control"
                value="{{ old('data_pagamento') }}"
            >
        </div>

        <br>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>

        <a href="{{ route('contas.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </form>
</div>
@endsection