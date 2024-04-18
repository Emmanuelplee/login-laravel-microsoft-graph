<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/puestos.json");
        $data = json_decode($json, true);
        // print_r(json_encode($data));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('puestos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {
            // print_r($obj);
            Puesto::create([
                'nombre'        => $obj['nombre'],
                'estatus'       => $obj['estatus'],
                'id_puesto_tipo' => $obj['id_puesto_tipo'],
            ]);
        }
    }
}
