<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index', [
            'clientes' => $clientes
        ]);
    }
    public function create()
    {
        return view('clientes.create');
    }
    public function store(\Illuminate\Http\Request $request)
    {

        $dados = $request->validate(
            [
                'nome' => 'required|string|max:255',
                'email' => 'required|email|unique:clientes,email',
                'telefone' => 'nullable|string|max:20',
            ],
            [
                'nome.required' => 'O nome é obrigatório.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'Digite um e-mail válido.',
                'email.unique' => 'Este e-mail já está cadastrado.',
                'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            ]
        );
        $dados['ativo'] = true;

        Cliente::create($dados);

        return redirect('/clientes')
            ->with('sucesso', 'Cliente cadastrado com sucesso!');
    }
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', [
            'cliente' => $cliente
        ]);
    }
    public function update(\Illuminate\Http\Request $request, Cliente $cliente)
    {
        $dados = $request->validate(
            [
                'nome' => 'required|string|max:255',
                'email' => 'required|email|unique:clientes,email,' . $cliente->id,
                'telefone' => 'nullable|string|max:20',
            ],
            [
                'nome.required' => 'O nome é obrigatório.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'Digite um e-mail válido.',
                'email.unique' => 'Este e-mail já está cadastrado.',
                'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
            ]
        );

        $cliente->update($dados);

        return redirect('/clientes')
            ->with('sucesso', 'Cliente atualizado com sucesso!');
    }
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('/clientes')
            ->with('sucesso', 'Cliente excluído com sucesso!');
    }
    public function toggle(Cliente $cliente)
    {
        $cliente->update([
            'ativo' => !$cliente->ativo
        ]);

        $mensagem = $cliente->ativo
            ? 'Cliente reativado com sucesso!'
            : 'Cliente desativado com sucesso!';

        return redirect('/clientes')
            ->with('sucesso', $mensagem);
    }
}
