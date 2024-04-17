<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTipo extends Model
{
    use HasFactory;

    protected $table = 'role_tipos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
    ];
}
