<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    public function run(): void
    {
        Configuracion::insert([
            [
                'clave'      => 'dias_alerta_vencimiento',
                'valor'      => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clave'      => 'vigencia_receta_simple_dias',
                'valor'      => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'clave'      => 'vigencia_receta_especial_dias',
                'valor'      => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}