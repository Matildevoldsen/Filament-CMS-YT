<li class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
    <div class="shrink-0">
        <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="{{ $item->variant->getFirstMediaUrl() }}" alt="{{ $item->variant->title }}"/>
    </div>

    <div class="relative flex flex-1 flex-col justify-between">
        <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
            <div class="pr-8 sm:pr-5">
                <p class="text-base font-semibold text-gray-900">{{ $item->product->title }}</p>
                <p class="mx-0 mt-1 mb-0 text-sm text-gray-400">
                    @foreach($item->variant->ancestorsAndSelf as $ancestor)
                        {{ $ancestor->title }}@if(!$loop->last) | @endif
                    @endforeach
                </p>
            </div>

            <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
                <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">{{ money($item->product->price) }}</p>

                <div class="sm:order-1">
                    <div class="mx-auto flex h-8 items-stretch text-gray-600">
                        <button wire:click="decrement" class="flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">-</button>
                        <div class="flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">{{ $item->quantity }}</div>
                        <button wire:click="increment" class="flex items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">+</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
            <button wire:click="remove" type="button" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class=""></path>
                </svg>
            </button>
        </div>
    </div>
</li>