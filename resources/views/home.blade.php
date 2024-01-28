<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl mb-4 text-center">Featured Posts</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl mb-4 text-center">Products</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($products as $product)
                   <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
