<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
    public function undo()
    {
        // Lógica para eliminar los datos insertados
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('activity_log')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
