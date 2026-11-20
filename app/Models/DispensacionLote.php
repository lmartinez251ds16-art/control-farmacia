<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DispensacionLote extends Model
{
    protected $table = 'dispensacion_lote';

    protected $fillable = ['detalle_id', 'lote_id', 'cantidad'];

    public function detalle(): BelongsTo
    {
        return $this->belongsTo(DispensacionDetalle::class, 'detalle_id');
    }

    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class);
    }
}