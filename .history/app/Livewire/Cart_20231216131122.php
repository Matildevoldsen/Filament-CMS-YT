<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $items;

    public function render()
    {
        return view('livewire.cart');
    }
}
