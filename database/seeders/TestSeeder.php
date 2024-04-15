<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/test.json");
        $data = json_decode($json, true);
        // print_r(json_encode($data));
        foreach ($data as $obj) {
            // print_r($obj);
            Test::create([
                'name'          => $obj['name'],
                'description'   => $obj['description'],
            ]);
        }
    }
}
