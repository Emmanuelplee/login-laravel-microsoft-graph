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
        Schema::create('solicitudes_pago_spds', function (Blueprint $table) {
            $table->id();

            $table->string('folio', 15);
            $table->string('centro_costo', 15)->nullable();
            $table->dateTime('fecha_hr_sdp')->nullable();
            $table->string('solicitante', 100)->nullable();
            $table->string('sub_conceptos', 150)->nullable();
            $table->string('cargo', 100)->nullable();
            $table->string('dirigido_a', 100)->nullable();
            $table->string('factura', 100)->nullable();
            $table->decimal('monto', 10,2)->nullable();
            $table->string('estatus', 100)->nullable();

            $table->json('archivos')->nullable();
            // buscar total del monto en archivos xmls
            $table->boolean('xml_estatus')->default(0);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('solicitudes_pago_spds');
    }
};
