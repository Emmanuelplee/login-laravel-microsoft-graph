<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role')->after('tipo')->nullable(); // Referencia a la tabla roles
            $table->unsignedBigInteger('id_puesto')->after('id_role')->nullable(); // Referencia a la tabla puestos
            $table->foreign('id_role')->references('id')->on('roles');
            $table->foreign('id_puesto')->references('id')->on('puestos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('id_role');
            $table->dropColumn('id_role');
            $table->dropForeign('id_puesto');
            $table->dropColumn('id_puesto');
        });
    }
};
