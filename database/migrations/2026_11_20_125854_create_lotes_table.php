<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicamento_id')->constrained('medicamentos')->restrictOnDelete();
            $table->foreignId('proveedor_id')->constrained('proveedores')->restrictOnDelete();
            $table->string('numero_lote', 50);
            $table->date('fecha_vencimiento');
            $table->integer('cantidad_inicial');
            $table->integer('cantidad_actual');
            $table->decimal('precio_compra', 10, 2);
            $table->string('comprobante_proveedor', 50);
            $table->enum('estado', ['vigente', 'vencido', 'baja'])->default('vigente');
            $table->timestamps();

            $table->unique(['medicamento_id', 'numero_lote']);
            $table->index(['medicamento_id', 'estado', 'fecha_vencimiento']);
        });
        DB::statement('ALTER TABLE lotes ADD CONSTRAINT chk_lotes_cant_inicial CHECK (cantidad_inicial > 0)');
        DB::statement('ALTER TABLE lotes ADD CONSTRAINT chk_lotes_cant_actual CHECK (cantidad_actual >= 0)');
        DB::statement('ALTER TABLE lotes ADD CONSTRAINT chk_lotes_precio_compra CHECK (precio_compra >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};