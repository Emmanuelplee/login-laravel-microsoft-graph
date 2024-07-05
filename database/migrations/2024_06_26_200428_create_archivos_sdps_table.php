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
        Schema::create('archivos_sdps', function (Blueprint $table) {
            $table->id();

            $table->enum('tipo',['NINGUNO','XML','PDF','IMAGEN'])->default('NINGUNO');
            $table->decimal('monto',10,2)->nullable()->default(0);
            $table->string('ruta', 100)->nullable();
            $table->timestamp('fecha_documento')->nullable();
            $table->string('uuid', 100)->nullable();
            $table->boolean('aprobado')->default(0);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('sdp_id');
            $table->foreign('sdp_id')->references('id')->on('solicitudes_pago_sdps')
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
        Schema::dropIfExists('archivos_sdps');
    }
};
