<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permissions extends SpatiePermission
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];
}
