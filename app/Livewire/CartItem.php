<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartManager;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Component
{
    public $item;

    public function getCartProperty()
    {
        return app(CartManager::class);
    }

    public function increment()
    {
        $this->item->quantity += 1;
        $this->item->save();
        $item = $this->item->variant ?? $this->item->product;

        $item->stock->decrementStock(1);

        $this->dispatch('cart.updated');
    }

    public function decrement()
    {
        $this->item->quantity -= 1;
        $this->item->save();
        $item = $this->item->variant ?? $this->item->product;

        $item->stock->incrementStock(1);

        if ($this->item->quantity == 0) {
            $this->item->delete();
        }

        $this->dispatch('cart.updated');
    }

    public function remove()
    {
        $this->item->delete();

        $item = $this->item->variant ?? $this->item->product;

        $item->stock->incrementStock($this->item->quantity);

        $this->dispatch('cart.updated');
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
