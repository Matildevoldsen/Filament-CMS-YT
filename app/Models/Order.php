<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'order_id',
        'status',
        'discount',
        'taxes',
        'total',
        'user_id',
        'address_id'
    ];

    public static function booted()
    {
        static::creating(function ($order) {
            $order->order_id = Str::uuid();
            $order->status = OrderStatus::PENDING;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('variants', 'quantity', 'price')
            ->withTimestamps();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
