<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function index()
    {
        $servicos = Servico::with('cliente')
            ->orderBy('id', 'desc')
            ->get();

        return view('servicos.index', compact('servicos'));
    }

    public function create()
    {
        $clientes = Cliente::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('servicos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_servico' => 'required|date',
            'situacao' => 'required|in:Pendente,Concluído,Cancelado',
        ], [
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'O cliente selecionado é inválido.',
            'descricao.required' => 'Informe a descrição do serviço.',
            'valor.required' => 'Informe o valor do serviço.',
            'valor.numeric' => 'O valor deve ser numérico.',
            'data_servico.required' => 'Informe a data do serviço.',
            'situacao.required' => 'Selecione a situação do serviço.',
        ]);

        Servico::create([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_servico' => $request->data_servico,
            'situacao' => $request->situacao,
            'ativo' => true,
        ]);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso!');
    }
    public function edit(Servico $servico)
    {
        $clientes = Cliente::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view('servicos.edit', compact('servico', 'clientes'));
    }

    public function update(Request $request, Servico $servico)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'data_servico' => 'required|date',
            'situacao' => 'required|in:Pendente,Concluído,Cancelado',
        ], [
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'O cliente selecionado é inválido.',
            'descricao.required' => 'Informe a descrição do serviço.',
            'valor.required' => 'Informe o valor do serviço.',
            'valor.numeric' => 'O valor deve ser numérico.',
            'data_servico.required' => 'Informe a data do serviço.',
            'situacao.required' => 'Selecione a situação do serviço.',
        ]);

        $servico->update([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_servico' => $request->data_servico,
            'situacao' => $request->situacao,
        ]);

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }
    public function toggle(Servico $servico)
    {
        $servico->update([
            'ativo' => !$servico->ativo,
        ]);

        $mensagem = $servico->ativo
            ? 'Serviço reativado com sucesso!'
            : 'Serviço desativado com sucesso!';

        return redirect()
            ->route('servicos.index')
            ->with('success', $mensagem);
    }
}
