<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartManager;

class CartItem extends Component
{
    public $item;
    protected $cart;

    public function remove()
    {
        $this->cart->remove($this->item->id);
    }

    public function mount()
    {
        $this->cart = app()->make(CartManager::class);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
