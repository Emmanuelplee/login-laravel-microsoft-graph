<?php

namespace App\Models;

use App\Models\User;
use App\Models\SolicitudPagoSdp;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions; // Esta es la clase correcta

class ArchivosSdps extends Model
{
    use HasFactory;
    use SoftDeletes;

    use LogsActivity;

    protected $table = 'archivos_sdps';

    protected $fillable = [
        'tipo',
        'monto',
        'ruta',
        'fecha_documento',
        'uuid',
        'aprobado',
        'user_id',
        'sdp_id',
    ];

    protected $casts = [
        // otros casts
        'fecha_documento' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function SolicitudPagoSdp()
    {
        return $this->belongsTo(SolicitudPagoSdp::class,'sdp_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['tipo','monto','ruta','fecha_documento','uuid','aprobado',
                    'user_id','sdp_id'])
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->useLogName('archivos sdps')
            ->setDescriptionForEvent(fn(string $eventName) => "Los archivos sdps han sido {$eventName}")
            ->logOnlyDirty();// Solo registra los campos realmente modificados
    }
}
