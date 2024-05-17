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
        Schema::table('roles', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('name');

            $table->unsignedBigInteger('id_role_tipo')->after('status');
            $table->foreign('id_role_tipo')->references('id')->on('role_tipos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->softDeletes(); // Agregar columna deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['id_role_tipo']);
            $table->dropColumn('id_role_tipo');
            $table->dropColumn('estatus');
        });
    }
};
