<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleTipo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'role_tipos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
    ];
}
