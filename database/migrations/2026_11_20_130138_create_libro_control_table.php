<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libro_control', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicamento_id')->constrained('medicamentos')->restrictOnDelete();
            $table->foreignId('lote_id')->nullable()->constrained('lotes')->restrictOnDelete();
            $table->unsignedInteger('correlativo');
            $table->dateTime('fecha');
            $table->enum('tipo', ['ingreso', 'salida', 'baja', 'ajuste', 'contra-asiento']);
            $table->foreignId('asiento_referencia_id')->nullable()->constrained('libro_control')->restrictOnDelete();
            $table->string('documento_respaldo', 100);
            $table->integer('cantidad');
            $table->integer('saldo_resultante');
            $table->foreignId('usuario_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            $table->unique(['medicamento_id', 'correlativo']);
        });
        DB::statement('ALTER TABLE libro_control ADD CONSTRAINT chk_libro_saldo CHECK (saldo_resultante >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('libro_control');
    }
};