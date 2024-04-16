<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\Sucursal;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/sucursales.json");
        $data = json_decode($json, true);
        // print_r(json_encode($data));

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('sucursales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {

            // print_r($obj);
            $estado = Estado::where('nombre','like','%'.$obj['estado'].'%')->get();
            Sucursal::create([
                'nombre'        => $obj['nombre'],
                'estado'        => $obj['estado'],
                'id_estado'     => $estado[0]->id
            ]);
        }
    }
}
