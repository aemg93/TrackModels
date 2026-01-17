<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'name',
        'token_rate',
        'multiplier',
    ];

    /**
     * Relación con usuarios (modelos)
     * Incluye credenciales en la tabla pivote platform_user
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'platform_user', 'platform_id', 'user_id')
                    ->withPivot(['platform_username', 'platform_password'])
                    ->withTimestamps();
    }
}
