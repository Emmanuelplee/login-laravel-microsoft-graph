<?php

namespace Database\Seeders;

use App\Models\PuestoTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PuestoTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('puesto_tipos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        PuestoTipo::create([
            'nombre'        => 'Administrativo',
            'descripcion'   => 'Puesto de administración',
            'estatus'       => 1
        ]);
        PuestoTipo::create([
            'nombre'        => 'Operativo',
            'descripcion'   => 'Puesto de operación',
            'estatus'       => 1
        ]);
    }
}
