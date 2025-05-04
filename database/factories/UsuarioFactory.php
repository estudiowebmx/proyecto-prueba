<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuarioAlias' => $this->faker->userName,
            'usuarioPassword' => Hash::make('123456'), // Usa MD5 si tu login lo requiere
            'usuarioNombre' => $this->faker->name,
            'usuarioEmail' => $this->faker->unique()->safeEmail(),
            'usuarioEstado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'usuarioConectado' => $this->faker->randomElement(['S', 'N']),
            'usuarioUltimaConexion' => $this->faker->dateTime(),
        ];
    }
}
