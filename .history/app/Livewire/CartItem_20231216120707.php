<?php

namespace App\Livewire;

use App\Services\CartManager;
use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected CartManager $cart;

    public function remove()
    {
        if (!$this->cart) return;
        
        $this->cart->getCart()->remove($this->item);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
