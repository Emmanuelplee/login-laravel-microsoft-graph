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
        // Ejecutar clase => php artisan db:seed --class=TestSeeder
        $this->call([
            // TestSeeder::class,
            TablesSeeder::class,

            AreasSeeder::class,
            CuentasSeeder::class,

            EstadosSeeder::class,
            SucursalesSeeder::class,

            RoleTiposSeeder::class,

            PuestoTiposSeeder::class,
            PuestosSeeder::class,

            RoleSeeder::class,// Ejecutar clase => php artisan db:seed --class=RoleSeeder
            PermisosSeeder::class,// Ejecutar clase => php artisan db:seed --class=PermisosSeeder

        ]);
        // * Seeders para pruebas ejecutar
        // php artisan db:seed --class=RoleFactorySeeder
        // php artisan db:seed --class=SolicitudPagoSdpSeeder


        // * Eliminar seeder ve app\Console\Commands\UndoSeeders.php
        // Ejecuta => php artisan db:undo-seeders
    }
}
