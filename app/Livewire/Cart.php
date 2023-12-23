<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartManager;

class Cart extends Component
{
    public $items;
    protected $listeners = [
        'cart.updated' => '$refresh'
    ];

    public function getCartProperty()
    {
        return app(CartManager::class);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
