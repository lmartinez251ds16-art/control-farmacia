<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo_interno', 'nombre_comercial', 'principio_activo', 'categoria_id',
        'presentacion', 'precio_venta', 'stock_minimo', 'condicion_venta',
        'lista_control_id', 'activo',
    ];

    protected function casts(): array
    {
        return [
            'precio_venta' => 'decimal:2',
            'activo' => 'boolean',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function listaControl(): BelongsTo
    {
        return $this->belongsTo(ListaControl::class);
    }

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class);
    }

    public function asientosControl(): HasMany
    {
        return $this->hasMany(LibroControl::class);
    }

    public function balancesTrimestrales(): HasMany
    {
        return $this->hasMany(BalanceTrimestral::class);
    }

    public function getStockVigenteAttribute(): int
    {
        return (int) $this->lotes()->where('estado', 'vigente')->sum('cantidad_actual');
    }
}