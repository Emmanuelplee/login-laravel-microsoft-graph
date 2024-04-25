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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('path_foto_perfil',100)->nullable()->comment('Ruta de la foto de perfil');

            $table->timestamp('inicio_sesion')->nullable()->comment('Hora de inicio de sesión');
            $table->ipAddress('ip_equipo')->nullable()->comment('IP del equipo');
            $table->boolean('activo')->default(1);
            $table->enum('tipo', ['NUEVO', 'EXTERNO', 'NOEXTERNO'])->default('NUEVO')->comment('Tipo de usuario');

            $table->rememberToken();
            $table->softDeletes(); // Agregar columna deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
