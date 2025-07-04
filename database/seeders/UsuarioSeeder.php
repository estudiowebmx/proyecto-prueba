<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'usuarioAlias' => 'admin',
            'usuarioPassword' => Hash::make('admin'),
            'usuarioNombre' => 'Raymundo Torres',
            'usuarioEmail' => 'admin@example.com',
            'usuarioEstado' => 'Activo',
            'usuarioConectado' => 'N',
            'usuarioUltimaConexion' => now(),
        ]);
        Usuario::factory()->count(50)->create();
    }
}
