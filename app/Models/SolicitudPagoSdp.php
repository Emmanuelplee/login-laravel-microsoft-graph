<?php

namespace App\Models;

use App\Models\ArchivosSdps;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudPagoSdp extends Model
{
    use HasFactory;
    use SoftDeletes;

    use LogsActivity;

    protected $table ='solicitudes_pago_sdps';


    protected $fillable = [
        'folio',
        'centro_costo',
        'fecha_hr_sdp',
        'solicitante',
        'sub_conceptos',
        'cargo',
        'dirigido_a',
        'factura',
        'monto',
        'estatus',
        'monto_tipo_archivo',
        'monto_comprobado',
        'aprobado',

        'xml_estatus',
        'user_id',
    ];

    protected $casts = [
        // otros casts
        'monto_tipo_archivo' => 'array',
        'fecha_hr_sdp' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // Las Solicitudes de pago tiene muchos archivos sdps
    public function ArchivosSdps()
    {
        return $this->hasMany(ArchivosSdps::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['folio','centro_costo','fecha_hr_sdp','solicitante','sub_conceptos',
                    'cargo','dirigido_a','factura','monto','estatus','archivos','xml_estatus',
                    'user_id',])
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->useLogName('solicitudes pago sdp')
            ->setDescriptionForEvent(fn(string $eventName) => "La solicitudes pago sdp ha sido {$eventName}")
            ->logOnlyDirty();// Solo registra los campos realmente modificados
    }
}
