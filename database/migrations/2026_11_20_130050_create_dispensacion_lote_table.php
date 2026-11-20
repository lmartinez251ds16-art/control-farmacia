<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispensacion_lote', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detalle_id')->constrained('dispensacion_detalle')->restrictOnDelete();
            $table->foreignId('lote_id')->constrained('lotes')->restrictOnDelete();
            $table->integer('cantidad');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE dispensacion_lote ADD CONSTRAINT chk_displote_cantidad CHECK (cantidad > 0)');
    }

    public function down(): void
    {
        Schema::dropIfExists('dispensacion_lote');
    }
};