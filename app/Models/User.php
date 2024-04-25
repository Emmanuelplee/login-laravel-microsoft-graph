<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Puesto;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alias',
        'name',
        'surname',
        'email',
        'password',

        'path_foto_perfil',
        'inicio_sesion',
        'ip_equipo',
        'activo',
        'tipo',
        'id_role',
        'id_puesto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        'inicio_sesion' => "datetime",
    ];
    // MARK: Atributos
    public function getInicioSesionAttribute($value)
    {
        return Carbon::parse($value)->format('h:i:s A');
    }
    // MARK: Releciones
    // relacion de user con el id de puestos
    public function puesto()
    {
        return $this->hasOne(Puesto::class, 'id');
    }

}
