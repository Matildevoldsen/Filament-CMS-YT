<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $items;
    protected $listeners = [
        'cart.updated' => '$refresh'
    ];
    
    public function render()
    {
        return view('livewire.cart');
    }
}
