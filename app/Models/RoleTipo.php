<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    //Un role_tipo puede tener múltiples roles asociados.
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'role_tipo_id');
    }
}
