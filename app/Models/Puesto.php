<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'puestos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estatus',
        'id_puesto_tipo',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_puestos');
    }
}
