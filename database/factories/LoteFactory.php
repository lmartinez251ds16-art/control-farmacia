<?php

namespace Database\Factories;

use App\Models\Medicamento;
use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lote>
 */
class LoteFactory extends Factory
{
    public function definition(): array
    {
        $cantidad = fake()->numberBetween(20, 150);

        return [
            'medicamento_id'        => Medicamento::factory(),
            'proveedor_id'          => Proveedor::factory(),
            'numero_lote'           => 'L-' . fake()->unique()->bothify('??####'),
            'fecha_vencimiento'     => fake()->dateTimeBetween('+2 months', '+2 years')->format('Y-m-d'),
            'cantidad_inicial'      => $cantidad,
            'cantidad_actual'       => $cantidad,
            'precio_compra'         => fake()->randomFloat(2, 0.20, 25.00),
            'comprobante_proveedor' => 'F001-' . fake()->numerify('######'),
            'estado'                => 'vigente',
        ];
    }

    public function vencido(): static
    {
        return $this->state(fn () => [
            'fecha_vencimiento' => fake()->dateTimeBetween('-6 months', '-1 day')->format('Y-m-d'),
            'estado'            => 'vencido',
        ]);
    }
}