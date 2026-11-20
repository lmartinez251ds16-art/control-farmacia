<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibroControl extends Model
{
    protected $table = 'libro_control';

    protected $fillable = [
        'medicamento_id', 'lote_id', 'correlativo', 'fecha', 'tipo',
        'asiento_referencia_id', 'documento_respaldo', 'cantidad',
        'saldo_resultante', 'usuario_id',
    ];

    protected function casts(): array
    {
        return ['fecha' => 'datetime'];
    }

    public function medicamento(): BelongsTo
    {
        return $this->belongsTo(Medicamento::class);
    }

    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function asientoReferencia(): BelongsTo
    {
        return $this->belongsTo(self::class, 'asiento_referencia_id');
    }
}