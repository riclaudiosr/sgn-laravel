@extends('layouts.app')

@section('title', 'Editar Serviço - SGN')

@section('content')

<div class="container">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Editar serviço
        </h2>

        <p class="text-muted mb-0">
            Atualize os dados do serviço cadastrado.
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
                action="{{ route('servicos.update', $servico) }}"
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
                                {{ old('cliente_id', $servico->cliente_id) == $cliente->id ? 'selected' : '' }}>

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
                        value="{{ old('descricao', $servico->descricao) }}"
                        placeholder="Ex.: Desenvolvimento de site"
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
                                    value="{{ old('valor', $servico->valor) }}"
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
                                for="data_servico"
                                class="form-label fw-semibold">

                                Data do serviço

                            </label>

                            <input
                                type="date"
                                name="data_servico"
                                id="data_servico"
                                class="form-control @error('data_servico') is-invalid @enderror"
                                value="{{ old('data_servico', $servico->data_servico) }}"
                                required>

                            @error('data_servico')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <label
                        for="situacao"
                        class="form-label fw-semibold">

                        Situação

                    </label>

                    <select
                        name="situacao"
                        id="situacao"
                        class="form-select @error('situacao') is-invalid @enderror"
                        required>

                        <option
                            value="Pendente"
                            {{ old('situacao', $servico->situacao) == 'Pendente' ? 'selected' : '' }}>

                            Pendente

                        </option>

                        <option
                            value="Concluído"
                            {{ old('situacao', $servico->situacao) == 'Concluído' ? 'selected' : '' }}>

                            Concluído

                        </option>

                        <option
                            value="Cancelado"
                            {{ old('situacao', $servico->situacao) == 'Cancelado' ? 'selected' : '' }}>

                            Cancelado

                        </option>

                    </select>

                    @error('situacao')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

                <div class="d-flex flex-column flex-sm-row gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Salvar alterações

                    </button>

                    <a
                        href="{{ route('servicos.index') }}"
                        class="btn btn-outline-secondary">

                        Voltar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
