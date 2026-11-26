<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\ListaControl;
use App\Models\Medicamento;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class CatalogoFarmaciaSeeder extends Seeder
{
    public function run(): void
    {
        Proveedor::factory()->count(5)->create();
        Cliente::factory()->count(25)->create();

        $categorias = Categoria::factory()->count(6)->create();

        $listaPsico = ListaControl::create([
            'codigo'      => 'IV-B',
            'descripcion' => 'Psicotrópicos sujetos a receta especial',
            'tipo'        => 'psicotropico',
        ]);

        Medicamento::factory()->count(12)->recycle($categorias)->create();
        Medicamento::factory()->conReceta()->count(6)->recycle($categorias)->create();
        Medicamento::factory()->controlado()->count(3)->create([
            'categoria_id'     => $categorias->first()->id,
            'lista_control_id' => $listaPsico->id,
        ]);
    }
}