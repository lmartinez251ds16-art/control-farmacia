<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dispensacion extends Model
{
    use HasFactory;

    protected $table = 'dispensaciones';

    protected $fillable = [
        'cliente_id', 'usuario_id', 'fecha', 'total', 'estado',
        'numero_receta', 'fecha_receta', 'medico_nombre', 'medico_cmp',
        'paciente_dni', 'paciente_nombres', 'receta_especial_numero',
        'receta_retenida', 'referencia_archivo_receta', 'autorizado_por',
        'motivo_anulacion',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'fecha_receta' => 'date',
            'total' => 'decimal:2',
            'receta_retenida' => 'boolean',
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function regenteAutorizador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autorizado_por');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DispensacionDetalle::class);
    }
}