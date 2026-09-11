<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicosController;
use App\Http\Controllers\ContasReceberController;
use App\Http\Controllers\RelatoriosController;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/novo', [ClientesController::class, 'create']);
Route::post('/clientes', [ClientesController::class, 'store']);
Route::get('/clientes/{cliente}/editar', [ClientesController::class, 'edit']);
Route::put('/clientes/{cliente}', [ClientesController::class, 'update']);
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);

Route::patch('/clientes/{cliente}/toggle', [ClientesController::class, 'toggle'])
    ->name('clientes.toggle');

Route::get('/servicos', [ServicosController::class, 'index'])
    ->name('servicos.index');

Route::get('/servicos/create', [ServicosController::class, 'create'])
    ->name('servicos.create');

Route::post('/servicos', [ServicosController::class, 'store'])
    ->name('servicos.store');

Route::get('/servicos/{servico}/edit', [ServicosController::class, 'edit'])
    ->name('servicos.edit');

Route::put('/servicos/{servico}', [ServicosController::class, 'update'])
    ->name('servicos.update');

Route::patch('/servicos/{servico}/toggle', [ServicosController::class, 'toggle'])
    ->name('servicos.toggle');

Route::get('/contas', [ContasReceberController::class, 'index'])
    ->name('contas.index');

Route::get('/contas/create', [ContasReceberController::class, 'create'])
    ->name('contas.create');

Route::post('/contas', [ContasReceberController::class, 'store'])
    ->name('contas.store');

Route::get('/contas/{conta}/edit', [ContasReceberController::class, 'edit'])
    ->name('contas.edit');

Route::put('/contas/{conta}', [ContasReceberController::class, 'update'])
    ->name('contas.update');

Route::patch('/contas/{conta}/toggle', [ContasReceberController::class, 'toggle'])
    ->name('contas.toggle');

Route::get('/relatorios', [RelatoriosController::class, 'index'])
    ->name('relatorios.index');

