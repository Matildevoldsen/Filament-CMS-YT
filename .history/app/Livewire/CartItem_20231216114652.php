<?php

namespace App\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;

    public function render()
    {
        return view('livewire.cart-item');
    }
}
