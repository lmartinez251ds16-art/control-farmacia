<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ruc'          => fake()->unique()->numerify('20#########'),
            'razon_social' => fake()->company() . ' S.A.C.',
            'telefono'     => fake()->numerify('084######'),
            'direccion'    => fake()->streetAddress(),
            'activo'       => true,
        ];
    }
}