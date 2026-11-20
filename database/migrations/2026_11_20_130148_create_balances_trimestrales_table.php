<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('balances_trimestrales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicamento_id')->constrained('medicamentos')->restrictOnDelete();
            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('trimestre');
            $table->integer('saldo_inicial');
            $table->integer('ingresos');
            $table->integer('salidas');
            $table->integer('ajustes');
            $table->integer('saldo_final');
            $table->foreignId('generado_por')->constrained('users')->restrictOnDelete();
            $table->dateTime('fecha_generacion');
            $table->timestamps();

            $table->unique(['medicamento_id', 'anio', 'trimestre']);
        });
        DB::statement('ALTER TABLE balances_trimestrales ADD CONSTRAINT chk_trimestre CHECK (trimestre BETWEEN 1 AND 4)');
    }

    public function down(): void
    {
        Schema::dropIfExists('balances_trimestrales');
    }
};