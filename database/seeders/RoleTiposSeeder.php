<?php

namespace Database\Seeders;

use App\Models\RoleTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('role_tipos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        RoleTipo::create([
            'nombre' => 'admin'
        ]);
        RoleTipo::create([
            'nombre' => 'general'
        ]);
        RoleTipo::create([
            'nombre' => 'area'
        ]);
        RoleTipo::create([
            'nombre' => 'sucursal'
        ]);
        RoleTipo::create([
            'nombre' => 'cuentas'
        ]);
    }
}
