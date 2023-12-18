<?php

namespace App\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected $cart;

    public function mount(CartItem $item, $cart)
    {
        $this->item = $item;
        $this->cart = $cart;
    }

    public function remove()
    {
        $this->cart->remove($this->item);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
