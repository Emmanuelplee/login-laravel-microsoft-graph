<?php

namespace Database\Seeders;

use DB;
use App\Models\Estado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/estados.json");
        $data = json_decode($json, true);
        // print_r(json_encode($data));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('estados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {
            // print_r($obj);
            Estado::create([
                'clave'     => $obj['clave'],
                'nombre'      => $obj['nombre'],
            ]);
        }
    }
}
