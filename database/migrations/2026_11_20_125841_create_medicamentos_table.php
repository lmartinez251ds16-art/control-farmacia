<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_interno', 30)->unique();
            $table->string('nombre_comercial', 120);
            $table->string('principio_activo', 120);
            $table->foreignId('categoria_id')->constrained('categorias')->restrictOnDelete();
            $table->string('presentacion', 80);
            $table->decimal('precio_venta', 10, 2);
            $table->integer('stock_minimo')->default(0);
            $table->enum('condicion_venta', ['libre', 'receta', 'controlado'])->default('libre');
            $table->foreignId('lista_control_id')->nullable()->constrained('listas_control')->restrictOnDelete();
            $table->boolean('activo')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE medicamentos ADD CONSTRAINT chk_medicamentos_precio CHECK (precio_venta >= 0)');
        DB::statement('ALTER TABLE medicamentos ADD CONSTRAINT chk_medicamentos_stock_min CHECK (stock_minimo >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};