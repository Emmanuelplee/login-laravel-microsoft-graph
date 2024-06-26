<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puesto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'puestos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
        'id_puesto_tipo',
    ];
    // El puesto pertenece a un solo usuario
    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id');
    }
}
