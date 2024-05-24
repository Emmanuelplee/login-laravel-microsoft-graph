<?php

namespace App\Exports;

use App\Models\Permissions;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelPermissionsExport implements FromCollection
{
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function collection()
    {
        return Permissions::whereIn('id', $this->data)->get();
    }
}
