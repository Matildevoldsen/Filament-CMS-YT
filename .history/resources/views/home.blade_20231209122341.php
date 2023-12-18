<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{ $cart->getCart()->items }}
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
