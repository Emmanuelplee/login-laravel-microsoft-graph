<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='sucursales';

    protected $fillable = [
        'nombre',
        'estaus',
        'id_estado',
    ];
}
