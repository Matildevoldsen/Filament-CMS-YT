<?php

namespace App\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected $cart;

    public function remove()
    {
        dd($this->cart);
        if (!$this->cart) return;
        $this->cart->remove($this->item);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
