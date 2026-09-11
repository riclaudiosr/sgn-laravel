@extends('layouts.app')

@section('title', 'Editar Conta - SGN')

@section('content')

<div class="container">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Editar conta
        </h2>

        <p class="text-muted mb-0">
            Atualize os dados da cobrança cadastrada.
        </p>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Corrija os erros abaixo:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $erro)

                            <li>
                                {{ $erro }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('contas.update', $conta) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label
                        for="cliente_id"
                        class="form-label fw-semibold">

                        Cliente

                    </label>

                    <select
                        name="cliente_id"
                        id="cliente_id"
                        class="form-select @error('cliente_id') is-invalid @enderror"
                        required>

                        @foreach($clientes as $cliente)

                            <option
                                value="{{ $cliente->id }}"
                                {{ old('cliente_id', $conta->cliente_id) == $cliente->id ? 'selected' : '' }}>

                                {{ $cliente->nome }}

                            </option>

                        @endforeach

                    </select>

                    @error('cliente_id')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="mb-3">

                    <label
                        for="descricao"
                        class="form-label fw-semibold">

                        Descrição

                    </label>

                    <input
                        type="text"
                        name="descricao"
                        id="descricao"
                        class="form-control @error('descricao') is-invalid @enderror"
                        value="{{ old('descricao', $conta->descricao) }}"
                        placeholder="Ex.: Mensalidade do sistema"
                        required>

                    @error('descricao')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label
                                for="valor"
                                class="form-label fw-semibold">

                                Valor

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    R$
                                </span>

                                <input
                                    type="number"
                                    name="valor"
                                    id="valor"
                                    class="form-control @error('valor') is-invalid @enderror"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('valor', $conta->valor) }}"
                                    required>

                            </div>

                            @error('valor')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label
                                for="data_vencimento"
                                class="form-label fw-semibold">

                                Data de vencimento

                            </label>

                            <input
                                type="date"
                                name="data_vencimento"
                                id="data_vencimento"
                                class="form-control @error('data_vencimento') is-invalid @enderror"
                                value="{{ old('data_vencimento', $conta->data_vencimento) }}"
                                required>

                            @error('data_vencimento')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label
                                for="status"
                                class="form-label fw-semibold">

                                Status

                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>

                                <option
                                    value="Pendente"
                                    {{ old('status', $conta->status) == 'Pendente' ? 'selected' : '' }}>
                                    Pendente
                                </option>

                                <option
                                    value="Pago"
                                    {{ old('status', $conta->status) == 'Pago' ? 'selected' : '' }}>
                                    Pago
                                </option>

                                <option
                                    value="Cancelado"
                                    {{ old('status', $conta->status) == 'Cancelado' ? 'selected' : '' }}>
                                    Cancelado
                                </option>

                            </select>

                            @error('status')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-4">

                            <label
                                for="data_pagamento"
                                class="form-label fw-semibold">

                                Data de pagamento

                            </label>

                            <input
                                type="date"
                                name="data_pagamento"
                                id="data_pagamento"
                                class="form-control @error('data_pagamento') is-invalid @enderror"
                                value="{{ old('data_pagamento', $conta->data_pagamento) }}">

                            @error('data_pagamento')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

                <div class="d-flex flex-column flex-sm-row gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Salvar alterações

                    </button>

                    <a
                        href="{{ route('contas.index') }}"
                        class="btn btn-outline-secondary">

                        Voltar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection