<x-app-layout>
    @section('title', $category->title)
    @section('meta_description', $category->meta_description)
    <div class="py-12">
        <div class="max-w-4xl bg-white p-5 rounded shadow-sm mx-auto sm:px-6 lg:px-8">


            <div id="custom-controls-gallery" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    @foreach($category->getMedia() as $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ $image->getUrl() }}"
                                 class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                 alt="">
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-center items-center pt-4">
                    <button type="button"
                            class="flex justify-center items-center me-4 h-full cursor-pointer group focus:outline-none"
                            data-carousel-prev>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="rtl:rotate-180 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
                    </button>
                    <button type="button"
                            class="flex justify-center items-center h-full cursor-pointer group focus:outline-none"
                            data-carousel-next>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="rtl:rotate-180 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
                    </button>
                </div>
            </div>

            <div class="space-y-2">
                <h1 class="text-2xl text-gray-900">
                    {{ $category->title }}
                </h1>
                <div>
                    {!! $category->content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
