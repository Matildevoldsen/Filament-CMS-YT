<?php

namespace App\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    protected $cart;

    public function remove($id)
    {
        $this->cart->remove($id);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
