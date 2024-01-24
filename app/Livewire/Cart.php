<?php

namespace App\Livewire;

use App\Models\ShippingType;
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

    public function getTotalProperty()
    {
        return $this->cart->getSubtotal() + ShippingType::first()->price;
    }

    public function getShippingPriceProperty()
    {
        return ShippingType::first()->price;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
