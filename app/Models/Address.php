<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address', 
        'address_2', 
        'city', 
        'postcode'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formattedAddress()
    {
        return sprintf(
            '%s, %s, %s, %s',
            $this->address,
            $this->address_2,
            $this->city,
            $this->postcode);
    }


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
