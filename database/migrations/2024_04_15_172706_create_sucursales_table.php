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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->boolean('estatus')->default(1);

            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estados')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes(); // Agregar columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
