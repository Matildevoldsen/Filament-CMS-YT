<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_id',
        'quantity',
        'user_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function decrementStock(int $quantity): Bool
    {
        if ($this->quantity < $quantity) {
            return false; //Not enough stock
        }

        $this->decrement('quantity', $quantity);

        return true;
    }

    public function incrementStock(int $quantity): void
    {
        $this->increment('quantity', $quantity);
        $this->save();
    }
}
