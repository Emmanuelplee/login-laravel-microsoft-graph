<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date; // garantizar sea fecha
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

//NOTE:Worksheet no es interfaz no es necesario en el implements
use Maatwebsite\Excel\Concerns\WithTitle; // titulo de hoja
use Maatwebsite\Excel\Concerns\WithHeadings; // cabeceras de excel
use Maatwebsite\Excel\Concerns\WithCustomStartCell; // celda de inicio
use Maatwebsite\Excel\Concerns\WithColumnFormatting; //formatear columnas
use Maatwebsite\Excel\Concerns\WithColumnWidths; //ancho de columnas manual
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;

use Maatwebsite\Excel\Concerns\ShouldAutoSize; //ancho de columnas automático
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;// Para Interactuar con style


class ExcelActivityLogExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle,WithStyles
                                    ,ShouldAutoSize, WithColumnWidths,WithColumnFormatting, WithMapping
{
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->data;
        // dd($data);
        return $data;
        // return Category::all();
    }
    //titulo de la hoja en propiedades
    public function title(): string
    {
        return 'Reporte de actividades';
    }
    public function startCell(): string
    {
        return 'A1';
    }
    //cabeceras del excel
    public function headings() : array
    {
        return ["ID",'TABLA','DESCRIPCION','TIPO MODELO','ID MODELO',
                // 'NOMBRE'
                'EVENTO','MODELO CAUSANTE','ID CAUSANTE','NOMBRE USUARIO',
                'PROPIEDADES','IP','HOST','NAVEGADOR','FECHA CREADO'];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('J:J')->getAlignment()->setWrapText(true);

        return [
            'A1:N1' => ['font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '000000',]
                    ],
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
            'A:N' => ['alignment' => [
                'horizontal'   => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ]],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'J' => 100, // columna 100 caracteres
        ];
    }
    public function columnFormats(): array
    {
        return [
            // 'C' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            // 'G' => 'yyyy-mm-dd H:mm:ss AM/PM',
            'N' => 'yyyy-mm-dd H:mm',
        ];
    }
    // Mapeo de datos a mostrar
    public function map($data): array
    {
        // $users = [];
        // foreach ($data['users']->toArray() as $key => $user){
        //     $roles = array_column($user['roles'], 'name'); //Extraer los nombres de los roles
        //     $rolesString = implode (', ', $roles); //Concatena los roles en una cadena
        //     $users[$key] = [$user['alias']. ' : ' .$rolesString,];
        // }
        // $result = array_column($users, 0);
        // dd($data);
        return [
            $data->id,
            $data->log_name,
            $data->description,
            $data->subject_type,
            $data->subject_id,
            $data->event,
            $data->causer_type,
            $data->causer_id,
            isset($data->user->alias) ? $data->user->alias : null,
            $data->properties,
            $data->ip,
            $data->host,
            $data->browser,
            isset($data['created_at']) ? Date::dateTimeToExcel($data['created_at']) : null, // Verificación de null para campos de fecha
            // $data->created_at,
            // implode('| ', $result),
        ];
    }
}
