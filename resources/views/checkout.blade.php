<x-app-layout>
    <livewire:checkout wire:key='1' :items="$cart->getCart()->items" />
</x-app-layout>
