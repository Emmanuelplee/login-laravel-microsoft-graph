<?php

namespace App\Models;

use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class CustomActivity extends SpatieActivity
{
    use HasFactory;

    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'ip',
        'host',
        'browser',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            $activity->ip = request()->ip();
            $activity->host = request()->getHost();

            // Ejemplo con la librería Agent para una descripción más detallada del navegador.
            $agent = new Agent();

            // Puedes personalizar esto para que incluya tanto el navegador como la plataforma, si lo deseas.
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $platform = $agent->platform();
            $platform_version = $agent->version($platform);

            $activity->browser = "{$browser} ({$version}) on {$platform} ({$platform_version})";
        });
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        //
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
