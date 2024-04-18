<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Ejecutar todo => php artisan migrate --seed
        // Ejecutar clase => php artisan db:seed --class=TestSeeader
        $this->call([
            // TestSeeder::class,
            AreasSeeder::class,
            CuentasSeeder::class,

            EstadosSeeder::class,
            SucursalesSeeder::class,

            RoleTiposSeeder::class,

            PuestoTiposSeeder::class,
            PuestosSeeder::class,
        ]);
    }
}
