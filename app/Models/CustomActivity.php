<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as SpatieActivity;
use Jenssegers\Agent\Agent;

class CustomActivity extends SpatieActivity
{
    use HasFactory;

    protected $table = 'activity_log';

    // protected static $logAttributes = ['ip', 'host', 'browser'];

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
}
