<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['dni', 'nombres', 'apellidos', 'telefono'];

    public function dispensaciones(): HasMany
    {
        return $this->hasMany(Dispensacion::class);
    }
}