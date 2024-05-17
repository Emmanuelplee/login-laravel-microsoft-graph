<?php

namespace App\Models;

use App\Models\RoleTipo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name',
        'status',
        'id_role_tipo',
    ];

    //Un rol pertenece a un único role_tipo
    public function roleTipo(): BelongsTo
    {
        return $this->belongsTo(RoleTipo::class, 'id_role_tipo');
    }

    // Por ejemplo, podrías agregar un método para obtener todos los usuarios asignados a un rol específico
    public function getUsers()
    {
        return $this->users()->get();
    }
}
