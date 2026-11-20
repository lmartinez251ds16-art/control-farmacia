<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispensacion_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispensacion_id')->constrained('dispensaciones')->restrictOnDelete();
            $table->foreignId('medicamento_id')->constrained('medicamentos')->restrictOnDelete();
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE dispensacion_detalle ADD CONSTRAINT chk_detalle_cantidad CHECK (cantidad > 0)');
        DB::statement('ALTER TABLE dispensacion_detalle ADD CONSTRAINT chk_detalle_precio CHECK (precio_unitario >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('dispensacion_detalle');
    }
};