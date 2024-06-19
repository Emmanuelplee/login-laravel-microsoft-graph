<?php

namespace App\Exports\ReportPermissions;

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


class ExcelTableOneExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle,WithStyles
                                    ,ShouldAutoSize, WithColumnWidths,WithColumnFormatting, WithMapping
{
    public $data;

    protected $permissions;

    public function __construct($data, $permissions) {
        $this->data = $data;
        $this->permissions = $permissions;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->data;
        return $data;
        // return Category::all();
    }
    //titulo de la hoja en propiedades
    public function title(): string
    {
        return 'Usuarios y permisos';
    }
    public function startCell(): string
    {
        return 'A1';
    }
    //cabeceras del excel
    public function headings() : array
    {
        return ["ID","ALIAS","NOMBRE","APELLIDO",'EMAIL','ROL','FECHA CREADO','PERMISOS'];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('H:H')->getAlignment()->setWrapText(true);

        return [
            'A1:H1' => ['font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '000000',]
                    ],
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
            // '1' => ['borders' => [
                // 'top' => ['borderStyle' =>Border::BORDER_THIN],
            // ]],
            'A:H' => ['alignment' => [
                'horizontal'   => Alignment::HORIZONTAL_CENTER,
            ]],
        ];
    }
    public function columnWidths(): array
    {
        return [
            'H' => 100, // columna 100 caracteres
        ];
    }
    public function columnFormats(): array
    {
        return [
            // 'C' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            // 'G' => 'yyyy-mm-dd H:mm:ss AM/PM',
            'G' => 'yyyy-mm-dd H:mm',
        ];
    }
    // Mapeo de datos a mostrar
    public function map($data): array
    {
        return [
            $data->id,
            $data->alias,
            $data->name,
            $data->surname,
            $data->email,
            $data->role,
            Date::dateTimeToExcel($data->created_at),
            // implode("\n", $data->permissions), // Convertir permisos a lista con saltos de línea
            implode(",", $data->permissions),

        ];
    }
}
