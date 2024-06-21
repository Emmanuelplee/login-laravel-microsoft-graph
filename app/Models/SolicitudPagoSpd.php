<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudPagoSpd extends Model
{
    use HasFactory;
    use SoftDeletes;

    use LogsActivity;

    protected $table ='solicitudes_pago_spds';

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

        'archivos',
        'xml_estatus',
        'user_id',
    ];

    protected $casts = [
        // otros casts
        'archivos' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['folio','centro_costo','fecha_hr_sdp','solicitante','sub_conceptos',
                    'cargo','dirigido_a','factura','monto','estatus','archivos','xml_estatus',
                    'user_id',])
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->useLogName('solicitudes pago spd')
            ->setDescriptionForEvent(fn(string $eventName) => "La solicitudes pago spd ha sido {$eventName}")
            ->logOnlyDirty();// Solo registra los campos realmente modificados
    }
}
