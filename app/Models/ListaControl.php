<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListaControl extends Model
{
    use HasFactory;

    protected $table = 'listas_control';

    protected $fillable = ['codigo', 'descripcion', 'tipo', 'activa'];

    protected function casts(): array
    {
        return ['activa' => 'boolean'];
    }

    public function medicamentos(): HasMany
    {
        return $this->hasMany(Medicamento::class);
    }
}