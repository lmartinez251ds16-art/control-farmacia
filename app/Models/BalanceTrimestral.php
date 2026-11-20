<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalanceTrimestral extends Model
{
    protected $table = 'balances_trimestrales';

    protected $fillable = [
        'medicamento_id', 'anio', 'trimestre', 'saldo_inicial',
        'ingresos', 'salidas', 'ajustes', 'saldo_final',
        'generado_por', 'fecha_generacion',
    ];

    protected function casts(): array
    {
        return ['fecha_generacion' => 'datetime'];
    }

    public function medicamento(): BelongsTo
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function generadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generado_por');
    }
}