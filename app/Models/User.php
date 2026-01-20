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
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active'            => 'boolean',
    ];

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'platform_user')
                    ->withPivot(['platform_username', 'platform_password'])
                    ->withTimestamps();
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class, 'user_id'); 
    }
    public function bonuses()
{
    return $this->hasMany(Bonus::class, 'user_id');
}

    public function discounts()
{
    return $this->hasMany(Discount::class, 'user_id');
}

}
