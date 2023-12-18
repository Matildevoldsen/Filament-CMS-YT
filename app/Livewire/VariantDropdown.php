<?php

namespace App\Livewire;

use App\Models\ProductVariation;
use Illuminate\Support\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class VariantDropdown extends Component
{
    public Collection $variations;
    public $selectedVariant;

    public $childVariations;

    public function updatedSelectedVariant($value)
    {
        $variant = ProductVariation::find($value);
        $this->childVariations = $variant->children;

        if ($variant->children->isEmpty()) {
            $this->dispatch('finalVariantSelected', $variant->id);
        }
    }

    public function render()
    {
        return view('livewire.variant-dropdown');
    }
}
