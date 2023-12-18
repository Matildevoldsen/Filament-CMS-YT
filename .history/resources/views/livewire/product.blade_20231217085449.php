<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    @if (count($product->getMedia()) > 1)
                        <x-gallery :media="$product->getMedia()"/>
                    @else
                        <img src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->meta_description }}"/>
                    @endif
                </div>
                <div>
                    <div class="mt-10">
                        <h2 class="text-2xl font-bold mb-3">
                            {{ $product->title }}
                        </h2>

                        {!! tiptap_converter()->asHTML($product->content) !!}
                    </div>
                    <div>
                        @if ($product->variations->count() > 0)
                            <livewire:variant-selector :product="$product"/>
                        @endif
                        @if ($finalVariantId)
                            <x-button wire:click="addToCart">
                                Pay {{ money($product->price) }}
                            </x-button>
                        @elseif(!empty($product->variations))
                            <x-button wire:click="addToCart">
                                Pay {{ money($product->price) }}
                            </x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
