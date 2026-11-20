<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispensaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->restrictOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('estado', ['registrada', 'anulada'])->default('registrada');
            $table->string('numero_receta', 50)->nullable();
            $table->date('fecha_receta')->nullable();
            $table->string('medico_nombre', 120)->nullable();
            $table->string('medico_cmp', 20)->nullable();
            $table->char('paciente_dni', 8)->nullable();
            $table->string('paciente_nombres', 150)->nullable();
            $table->string('receta_especial_numero', 50)->nullable();
            $table->boolean('receta_retenida')->default(false);
            $table->string('referencia_archivo_receta', 100)->nullable();
            $table->foreignId('autorizado_por')->nullable()->constrained('users')->restrictOnDelete();
            $table->text('motivo_anulacion')->nullable();
            $table->timestamps();

            $table->index(['fecha', 'estado']);
        });
        DB::statement('ALTER TABLE dispensaciones ADD CONSTRAINT chk_dispensaciones_total CHECK (total >= 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('dispensaciones');
    }
};