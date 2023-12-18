<div class="mb-5">
    @if ($variations)
        <label for="variations">Select {{ $variations[0]['type'] }}</label>
        <select wire:model.live="selectedVariant"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="variations"
                id="variations">
            <option value="">Select {{ $variations[0]['type'] }}</option>
            @foreach($variations as $variant)
                <option value="{{ $variant->id }}">{{ $variant->title }}</option>
            @endforeach
        </select>
    @endif

    @if ($childVariations && $childVariations->isNotEmpty())
        <livewire:variant-dropdown :variations="$childVariations" :key="$selectedVariant"/>
    @endif
</div>
