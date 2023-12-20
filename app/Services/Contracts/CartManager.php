<?php

namespace App\Services\Contracts;

use App\Models\Product;

interface CartManager
{
    public function add($productId, $variantId = null);
    public function exists();
    public function associateWithUser();

    public function getCart();
    public function getSubtotal();
}
