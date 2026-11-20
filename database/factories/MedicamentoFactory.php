<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\ListaControl;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamento>
 */
class MedicamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo_interno'   => 'MED-' . fake()->unique()->numerify('#####'),
            'nombre_comercial' => fake()->randomElement(['Panadol', 'Amoxil', 'Losartán Genfar', 'Omeprazol MK', 'Apronax', 'Diazepam']) . ' ' . fake()->randomElement(['500mg', '250mg', '50mg', '20mg', '10mg']),
            'principio_activo' => fake()->randomElement(['Paracetamol', 'Amoxicilina', 'Losartán', 'Omeprazol', 'Naproxeno', 'Diazepam']),
            'categoria_id'     => Categoria::factory(),
            'presentacion'     => fake()->randomElement(['Tableta', 'Cápsula', 'Jarabe 120ml', 'Ampolla']),
            'precio_venta'     => fake()->randomFloat(2, 0.50, 45.00),
            'stock_minimo'     => fake()->numberBetween(10, 50),
            'condicion_venta'  => 'libre',
            'lista_control_id' => null,
            'activo'           => true,
        ];
    }

    public function conReceta(): static
    {
        return $this->state(fn () => ['condicion_venta' => 'receta']);
    }

    public function controlado(): static
    {
        return $this->state(fn () => [
            'condicion_venta'  => 'controlado',
            'lista_control_id' => ListaControl::factory(),
        ]);
    }
}