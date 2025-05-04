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
        Schema::create('seg_usuario', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('usuarioAlias', 75)->nullable();
            $table->string('usuarioPassword', 75)->nullable();
            $table->string('usuarioNombre', 100)->nullable();
            $table->string('usuarioEmail', 100)->nullable();
            $table->enum('usuarioEstado', ['Activo', 'Inactivo'])->nullable();
            $table->char('usuarioConectado', 1)->nullable();
            $table->dateTime('usuarioUltimaConexion')->nullable();
            $table->string('usuarioImagen')->nullable();
            $table->string('usuarioCodigoVerificacion')->nullable();
            $table->timestamp('usuarioCodigoGeneradoAt')->nullable();
            $table->primary('idUsuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seg_usuario');
    }
};
