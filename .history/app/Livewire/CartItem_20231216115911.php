<?php

namespace App\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected $cart;

    public function remove()
    {
        $this->cart->remove($this->item->id ?? $this->item->id);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
