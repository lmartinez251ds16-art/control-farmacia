<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('dni', 8)->unique()->after('email');
            $table->enum('rol', ['administrador', 'almacenero', 'tecnico_farmacia'])
                  ->default('tecnico_farmacia')->after('password');
            $table->boolean('permiso_regente')->default(false)->after('rol');
            $table->boolean('activo')->default(true)->after('permiso_regente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dni', 'rol', 'permiso_regente', 'activo']);
        });
    }
};