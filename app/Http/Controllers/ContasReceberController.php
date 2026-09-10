<?php

namespace App\Http\Controllers;

use App\Models\ContaReceber;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ContasReceberController extends Controller
{

    public function index(Request $request)
    {
        $query = ContaReceber::with('cliente');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $contas = $query
            ->orderBy('data_vencimento')
            ->get();

        $totalPendente = ContaReceber::where('status', 'Pendente')
            ->where('ativo', true)
            ->sum('valor');

        $totalPago = ContaReceber::where('status', 'Pago')
            ->where('ativo', true)
            ->sum('valor');

        $quantidadePendente = ContaReceber::where('status', 'Pendente')
            ->where('ativo', true)
            ->count();

        return view('contas.index', compact(
            'contas',
            'totalPendente',
            'totalPago',
            'quantidadePendente'
        ));
    }
    public function create()
    {
        $clientes = Cliente::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('contas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_vencimento' => 'required|date',
            'status' => 'required|in:Pendente,Pago,Cancelado',
            'data_pagamento' => 'nullable|date',
        ], [
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'O cliente selecionado é inválido.',
            'descricao.required' => 'Informe a descrição da conta.',
            'valor.required' => 'Informe o valor da conta.',
            'valor.numeric' => 'O valor deve ser numérico.',
            'data_vencimento.required' => 'Informe a data de vencimento.',
            'status.required' => 'Selecione o status da conta.',
        ]);

        ContaReceber::create([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'status' => $request->status,
            'data_pagamento' => $request->data_pagamento,
            'ativo' => true,
        ]);

        return redirect()
            ->route('contas.index')
            ->with('success', 'Conta cadastrada com sucesso!');
    }
    public function edit(ContaReceber $conta)
    {
        $clientes = Cliente::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('contas.edit', compact('conta', 'clientes'));
    }

    public function update(Request $request, ContaReceber $conta)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_vencimento' => 'required|date',
            'status' => 'required|in:Pendente,Pago,Cancelado',
            'data_pagamento' => 'required_if:status,Pago|nullable|date',
        ]);

        $conta->update([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_vencimento' => $request->data_vencimento,
            'status' => $request->status,
            'data_pagamento' => $request->status === 'Pago'
                ? $request->data_pagamento
                : null,
        ]);

        return redirect()
            ->route('contas.index')
            ->with('success', 'Conta atualizada com sucesso!');
    }
    public function toggle(ContaReceber $conta)
    {
        $conta->update([
            'ativo' => !$conta->ativo,
        ]);

        $mensagem = $conta->ativo
            ? 'Conta reativada com sucesso!'
            : 'Conta desativada com sucesso!';

        return redirect()
            ->route('contas.index')
            ->with('success', $mensagem);
    }
}
