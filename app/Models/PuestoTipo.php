<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuestoTipo extends Model
{
    use HasFactory;

    protected $table = 'puesto_tipos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
    ];
}
