<?php

namespace App\Console\Commands;

use Database\Seeders\ActivityLogSeeder;
use Illuminate\Console\Command;
use Database\Seeders\PermisosSeeder;
use Database\Seeders\RoleFactorySeeder;
use Database\Seeders\SolicitudPagoSdpSeeder;

class UndoSeeders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:undo-seeders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revertir datos poblados por los seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Revirtiendo datos poblados por los seeders...');

        // Llamar a los métodos undo de cada seeder
        // (new RoleFactorySeeder)->undo();
        // (new PermisosSeeder)->undo();
        // (new ActivityLogSeeder)->undo();
        (new SolicitudPagoSdpSeeder)->undo();

        $this->info('Datos revertidos exitosamente.');
    }
}
