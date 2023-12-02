<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'user_id'
    ];

    public function add($cartID, $quantity, $productID, $variant = null)
    {
        $item = $this->items()->where('cart_id', $cartID)
                                ->where('product_id', $productID)
                                ->where('variant', $variant)
                                ->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            $this->items()->create([
                'product_id' => $productID,
                'quantity' => $quantity,
                'variant' => $variant
            ]);
        }
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
