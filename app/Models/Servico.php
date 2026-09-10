<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = [
        'cliente_id',
        'descricao',
        'valor',
        'data_servico',
        'situacao',
        'ativo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}