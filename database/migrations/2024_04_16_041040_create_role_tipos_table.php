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
        Schema::create('role_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->longText('descripcion',500)->nullable();
            $table->boolean('estatus')->default(1);
            $table->timestamps();
            $table->softDeletes(); // Agregar columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_tipos');
    }
};
