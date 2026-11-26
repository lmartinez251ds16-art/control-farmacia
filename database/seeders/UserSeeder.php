<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // La contraseña por defecto de todos los usuarios es: password
        User::factory()->create([
            'name'            => 'Q.F. Carlos Mendoza (Regente)',
            'email'           => 'regente@farmacia.test',
            'dni'             => '41234567',
            'rol'             => 'administrador',
            'permiso_regente' => true,
        ]);

        User::factory()->create([
            'name'            => 'Administrador General',
            'email'           => 'admin@farmacia.test',
            'dni'             => '42345678',
            'rol'             => 'administrador',
            'permiso_regente' => false,
        ]);

        User::factory()->create([
            'name'            => 'Ana Torres (Almacén)',
            'email'           => 'almacen@farmacia.test',
            'dni'             => '43456789',
            'rol'             => 'almacenero',
            'permiso_regente' => false,
        ]);

        User::factory()->create([
            'name'            => 'Pedro Quispe (Técnico)',
            'email'           => 'tecnico@farmacia.test',
            'dni'             => '44567890',
            'rol'             => 'tecnico_farmacia',
            'permiso_regente' => false,
        ]);
    }
}