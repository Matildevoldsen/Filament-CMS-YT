<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Navigation as NavigationModel;

class Navigation extends Component
{
    public NavigationModel $navigation;
    public array $navigationItems;
    public array $navigationItemsSidebar;

    public function mount()
    {
        $this->navigation = NavigationModel::first();
        $this->navigationItems = $this->navigation->items;
        $this->navigationItemsSidebar = $this->navigation->items_sidebar;
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
