<?php

namespace App\Exports;

use App\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelRolesExport implements FromCollection
{
    public $roles;

    public function __construct($roles) {
        $this->roles = $roles;
    }

    public function collection()
    {
        return Role::whereIn('id', $this->roles)->get();
    }
}
