<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ms_graph_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(); //ID usuario al que pertenecen este token.
            $table->string('email')->nullable();
            //* Es el token de acceso proporcionado por Microsoft Graph.
            //* Este token se usa para solicitudes a la API de Microsoft Graph con usuario autenticado.
            $table->text('access_token');
            //* Token de actualización dado por Microsoft Graph.
            //* Se usa para obtener un nuevo token de acceso cuando el token actual expira.
            $table->text('refresh_token')->nullable();
            //* Fecha de expiracion del token.
            $table->string('expires');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ms_graph_tokens');
    }
};
