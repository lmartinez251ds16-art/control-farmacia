<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DispensacionDetalle extends Model
{
    protected $table = 'dispensacion_detalle';

    protected $fillable = ['dispensacion_id', 'medicamento_id', 'cantidad', 'precio_unitario'];

    protected function casts(): array
    {
        return ['precio_unitario' => 'decimal:2'];
    }

    public function dispensacion(): BelongsTo
    {
        return $this->belongsTo(Dispensacion::class);
    }

    public function medicamento(): BelongsTo
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function lotesAsignados(): HasMany
    {
        return $this->hasMany(DispensacionLote::class, 'detalle_id');
    }
}