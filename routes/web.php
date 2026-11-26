<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentoController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('clientes', ClienteController::class);

Route::resource('medicamentos', MedicamentoController::class)
    ->except(['destroy']);

Route::patch('medicamentos/{medicamento}/estado', [MedicamentoController::class, 'cambiarEstado'])
    ->name('medicamentos.estado');
