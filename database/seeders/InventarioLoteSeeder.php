<?php

namespace Database\Seeders;

use App\Models\LibroControl;
use App\Models\Lote;
use App\Models\Medicamento;
use App\Models\MovimientoInventario;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Seeder;

class InventarioLoteSeeder extends Seeder
{
    public function run(): void
    {
        $regente = User::where('permiso_regente', true)->first();
        $proveedores = Proveedor::all();
        $correlativos = [];

        foreach (Medicamento::all() as $med) {
            // 2 lotes vigentes con fechas distintas para probar FEFO (RN05)
            foreach ([1, 2] as $idx) {
                $lote = Lote::factory()->create([
                    'medicamento_id'    => $med->id,
                    'proveedor_id'      => $proveedores->random()->id,
                    'fecha_vencimiento' => now()->addMonths($idx * 4)->format('Y-m-d'),
                    'cantidad_inicial'  => 50,
                    'cantidad_actual'   => 50,
                    'estado'            => 'vigente',
                ]);

                MovimientoInventario::create([
                    'lote_id'    => $lote->id,
                    'tipo'       => 'ingreso',
                    'cantidad'   => 50,
                    'motivo'     => 'Carga inicial de inventario',
                    'usuario_id' => $regente->id,
                    'fecha'      => now(),
                ]);

                if ($med->condicion_venta === 'controlado') {
                    $correlativos[$med->id] = ($correlativos[$med->id] ?? 0) + 1;
                    $saldoAnterior = ($correlativos[$med->id] - 1) * 50;

                    LibroControl::create([
                        'medicamento_id'     => $med->id,
                        'lote_id'            => $lote->id,
                        'correlativo'        => $correlativos[$med->id],
                        'fecha'              => now(),
                        'tipo'               => 'ingreso',
                        'documento_respaldo' => $lote->comprobante_proveedor,
                        'cantidad'           => 50,
                        'saldo_resultante'   => $saldoAnterior + 50,
                        'usuario_id'         => $regente->id,
                    ]);
                }
            }

            // 1 lote vencido para probar RN04
            Lote::factory()->vencido()->create([
                'medicamento_id' => $med->id,
                'proveedor_id'   => $proveedores->random()->id,
            ]);
        }
    }
}