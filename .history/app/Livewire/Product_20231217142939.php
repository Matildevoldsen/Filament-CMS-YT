<?php

namespace App\Livewire;

use App\Models\ProductVariation;
use App\Services\CartManager;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public ProductModel $product;
    public int $finalVariantId;
    #[On('finalVariantSelected')]
    public function handleFinalVariant($id)
    {
        $this->finalVariantId = (int) $id;
    }

    public function addToCart(): void
    {
        $cart = app(CartManager::class);

        $productVariation = ProductVariation::find($this->finalVariantId);

        $cart->add($productVariation->product->id, $productVariation->id);

        $this->dispatch('cart.updated');
    }

    public function render()
    {
        return view('livewire.product');
    }
}
