<?php

namespace App\Http\Controllers;

use App\Models\ContaReceber;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function index(Request $request)
    {
        $query = ContaReceber::with('cliente');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('data_inicial')) {
            $query->whereDate('data_vencimento', '>=', $request->data_inicial);
        }

        if ($request->filled('data_final')) {
            $query->whereDate('data_vencimento', '<=', $request->data_final);
        }

        $contas = $query
            ->orderBy('data_vencimento')
            ->get();

        $totalPendente = $contas
            ->where('status', 'Pendente')
            ->sum('valor');

        $totalPago = $contas
            ->where('status', 'Pago')
            ->sum('valor');

        return view('relatorios.index', compact(
            'contas',
            'totalPendente',
            'totalPago'
        ));
    }
}