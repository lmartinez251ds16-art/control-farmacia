<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListaControl>
 */
class ListaControlFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo'      => 'LISTA-' . fake()->unique()->numerify('###'),
            'descripcion' => 'Sustancias sujetas a fiscalización sanitaria',
            'tipo'        => fake()->randomElement(['estupefaciente', 'psicotropico']),
            'activa'      => true,
        ];
    }
}