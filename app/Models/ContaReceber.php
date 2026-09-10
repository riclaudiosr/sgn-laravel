<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    protected $fillable = [
        'cliente_id',
        'descricao',
        'valor',
        'data_vencimento',
        'status',
        'data_pagamento',
        'ativo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}