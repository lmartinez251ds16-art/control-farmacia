<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Medicamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo_interno', 'nombre_comercial', 'principio_activo', 'categoria_id',
        'presentacion', 'precio_venta', 'stock_minimo', 'condicion_venta',
        'lista_control_id', 'activo',
    ];

    public const CONDICIONES_VENTA = [
        'libre'      => 'Venta libre',
        'receta'     => 'Con receta médica',
        'controlado' => 'Controlado (receta especial)',
    ];

    public function scopeActivos(Builder $consulta): void
    {
        $consulta->where('activo', true);
    }

    public function scopeDeCategoria(Builder $consulta, ?int $categoriaId): void
    {
        if ($categoriaId) {
            $consulta->where('categoria_id', $categoriaId);
        }
    }

    public function scopeDeCondicion(Builder $consulta, ?string $condicion): void
    {
        if ($condicion) {
            $consulta->where('condicion_venta', $condicion);
        }
    }

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