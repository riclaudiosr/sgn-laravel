<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Servico;
use App\Models\ContaReceber;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();

        $clientesAtivos = Cliente::where('ativo', true)->count();

        $servicosAtivos = Servico::where('ativo', true)->count();

        $totalPendente = ContaReceber::where('status', 'Pendente')
            ->where('ativo', true)
            ->sum('valor');

        $totalPago = ContaReceber::where('status', 'Pago')
            ->where('ativo', true)
            ->sum('valor');

        $totalVencido = ContaReceber::where('status', 'Pendente')
            ->where('ativo', true)
            ->whereDate('data_vencimento', '<', now()->toDateString())
            ->sum('valor');

        $ultimosClientes = Cliente::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', [
            'totalClientes' => $totalClientes,
            'clientesAtivos' => $clientesAtivos,
            'servicosAtivos' => $servicosAtivos,
            'totalPendente' => $totalPendente,
            'totalPago' => $totalPago,
            'totalVencido' => $totalVencido,
            'ultimosClientes' => $ultimosClientes
        ]);
    }
}