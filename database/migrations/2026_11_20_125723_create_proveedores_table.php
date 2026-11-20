<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {$table->id();
            $table->char('ruc', 11)->unique();$table->string('razon_social', 150);
            $table->string('telefono', 15)->nullable();$table->string('direccion', 200)->nullable();
            $table->boolean('activo')->default(true);$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};