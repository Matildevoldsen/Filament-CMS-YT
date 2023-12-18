<?php

namespace App\Livewire;

use App\Services\CartManager;
use Livewire\Component;

class CartItem extends Component
{
    public $item;

    public function remove()
    {
        $this->item->delete();

        $this->dispatch('cartUpdated');

    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
