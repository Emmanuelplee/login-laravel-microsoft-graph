<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/permisos.json");
        $data = json_decode($json, true);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {
            // print_r($obj);
            Permission::create([
                'id'          => $obj['id'],
                'name'        => $obj['name'],
                'description' => $obj['description'],
            ]);
        }
    }
    public function undo()
    {
        // Lógica para eliminar los datos insertados
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
