<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','platform_id','amount_usd','reason','period',
        'installments','current_installment','remaining_amount',
    ];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function platform() { return $this->belongsTo(Platform::class, 'platform_id'); }
}
