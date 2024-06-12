<?php

namespace App\Models;

use App\Models\RoleTipo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use HasFactory;
    use SoftDeletes;

    use LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','status','id_role_tipo'])
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->useLogName('role')
            ->setDescriptionForEvent(fn(string $eventName) => "El rol ha sido {$eventName}")
            ->logOnlyDirty();// Solo registra los campos realmente modificados
    }
}

