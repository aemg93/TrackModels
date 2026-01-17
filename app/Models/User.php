<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'name',
        'last_name',
        'stage_name',
        'email',
        'contact',
        'phone',
        'address',
        'country',
        'city',
        'avatar',
        'birth_date',
        'gender',
        'bio',
        'document_path',
        'social_links',
        'active',
        'earnings',
        'password',
    ];

    /**
     * Campos ocultos al serializar
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
        'earnings' => 'decimal:2',
    ];

    /**
     * Relación con plataformas
     * Incluye credenciales en la tabla pivote platform_user
     */
    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'platform_user')
                    ->withPivot(['platform_username', 'platform_password'])
                    ->withTimestamps();
    }
}
