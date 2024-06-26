<?php

namespace Database\Seeders;

use App\Models\RoleTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/role_tipos.json");
        $data = json_decode($json, true);
        // print_r(json_encode($data));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('role_tipos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {
            // print_r($obj);
            RoleTipo::create([
                'nombre'        => $obj['nombre'],
                'descripcion'   => $obj['descripcion'],
                'estatus'       => $obj['estatus'],
            ]);
        }
    }
}
