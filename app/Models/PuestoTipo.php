<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuestoTipo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'puesto_tipos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
    ];
}
