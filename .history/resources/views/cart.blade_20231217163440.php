<x-app-layout>
    <livewire:cart :items="$cart->getCart()->items->with('product')" />
</x-app-layout>
