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
            'nombre' => 'admin',
            'descripcion' => 'El rol de tipo admin',
            'estatus' => 1,
        ]);
        RoleTipo::create([
            'nombre' => 'general',
            'descripcion' => 'El rol de tipo general',
            'estatus' => 1,
        ]);
        RoleTipo::create([
            'nombre' => 'area',
            'descripcion' => 'El rol de tipo area',
            'estatus' => 1,
        ]);
        RoleTipo::create([
            'nombre' => 'sucursal',
            'descripcion' => 'El rol de tipo sucursal',
            'estatus' => 1,
        ]);
        RoleTipo::create([
            'nombre' => 'cuentas',
            'descripcion' => 'El rol de tipo cuentas',
            'estatus' => 1,
        ]);
    }
}
