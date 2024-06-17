<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permissions extends SpatiePermission
{
    use HasFactory;

    use LogsActivity;

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','description'])
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->useLogName('permiso')
            ->setDescriptionForEvent(fn(string $eventName) => "El permiso ha sido {$eventName}")
            ->logOnlyDirty();// Solo registra los campos realmente modificados
    }
}
