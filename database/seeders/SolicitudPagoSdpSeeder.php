<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\SolicitudPagoSpd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SolicitudPagoSdpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/devUtils/solicitudes_pago_spd.json");
        $data = json_decode($json, true);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('solicitudes_pago_spds')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        foreach ($data as $obj) {
            // print_r($obj);
            // Limpiar el string eliminando el guion y espacios extras
            // $cleanDateString = str_replace(' - ', ' ', $obj['fecha_hr_sdp']);
            // Convertir el string limpio a una instancia de Carbon
            $date = Carbon::createFromFormat('Y-m-d h:i:s A', $obj['fecha_hr_sdp']);

            // Eliminar el símbolo de moneda y las comas
            // $cleanValue = str_replace(['$', ','], '', $obj['monto']);
            // Convertir el valor limpio a un número flotante
            // $decimalValue = (float) $cleanValue;
            SolicitudPagoSpd::create([
                'folio'         => $obj['folio'],
                'centro_costo'  => $obj['centro_costo'],
                'fecha_hr_sdp'  => $date,
                'solicitante'   => $obj['solicitante'],
                'sub_conceptos' => $obj['sub_conceptos'],
                'cargo'         => $obj['cargo'],
                'dirigido_a'    => $obj['dirigido_a'],
                'factura'       => $obj['factura'],
                'monto'         => $obj['monto'],
                'estatus'       => $obj['estatus'],
                'user_id'       => 1,
            ]);
        }
    }
    public function undo()
    {
        // Lógica para eliminar los datos insertados
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('solicitudes_pago_spds')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
