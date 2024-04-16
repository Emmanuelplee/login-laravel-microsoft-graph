<?php

namespace Database\Seeders;

use App\Models\PuestoTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuestoTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PuestoTipo::create([
            'nombre'        => 'Administrativo',
            'descripcion'   => 'Puesto de administración',
            'estatus'       => 1
        ]);
        PuestoTipo::create([
            'nombre'        => 'Operativo',
            'descripcion'   => 'Puesto de operación',
            'estatus'       => 1
        ]);
    }
}
