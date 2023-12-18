<?php

namespace App\Services\Contracts;

use App\Models\CartItem;

interface CartManager
{
    public function add($productId, $variantId = null);
    public function exists();
    public function associateWithUser();

    public function remove(CartItem $item);
    public function update();
    public function getCart();
    public function getSubtotal();
}
