<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        // ✅ corregido
        'platform_id',
        'amount_tokens',  // ✅ usa los nombres reales de columnas
        'amount_usd',
        'exchange_rate',
        'period',
    ];

    protected $casts = [
        'amount_tokens' => 'decimal:2',
        'amount_usd'    => 'decimal:2',
        'exchange_rate' => 'decimal:6',
        'period'        => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // ✅ corregido
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
}
