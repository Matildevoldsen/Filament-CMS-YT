<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Product as ProductModel;
class VariantSelector extends Component
{
    public ProductModel $product;
    public Collection $variations;

    public function mount()
    {
        $this->variations = $this->product->variations->sortBy('order')->groupBy('type')->first();
    }

    public function render()
    {
        return view('livewire.variant-selector');
    }
}
