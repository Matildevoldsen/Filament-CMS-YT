<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class VariantDropdown extends Component
{
    public Collection $variations;

    public function render()
    {
        return view('livewire.variant-dropdown');
    }
}
