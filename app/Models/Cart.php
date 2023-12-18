<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'user_id'
    ];

    public static function booted()
    {
        static::creating(function ($cart) {
            $cart->cart_id = (string) Str::uuid();
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
