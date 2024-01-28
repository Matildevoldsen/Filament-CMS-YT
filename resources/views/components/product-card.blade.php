<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('products.show', $product) }}">
        <img class="rounded-t-lg" src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->title }}"/>
    </a>
    <div class="p-5">
        <header class="lg:mb-6 not-format">
            <div class="mb-4">
                @foreach($product->categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">
                <span style="background-color:{{ $category->bg_color }};color: {{ $category->text_color }};"
                      class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    {{ $category->title }}
                </span>
                    </a>
                @endforeach
            </div>
        </header>
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->title }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {!! $product->excerpt() !!}
        </p>
        <a href="{{ route('products.show', $product) }}"
           class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Read more
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>
