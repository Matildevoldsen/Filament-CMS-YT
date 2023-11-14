<x-app-layout>
    @section('title', $category->title)
    @section('meta_description', $category->meta_description)
    <div class="py-12">
        <div class="max-w-4xl bg-white p-5 rounded shadow-sm mx-auto sm:px-6 lg:px-8">
            @if (count($category->getMedia()) > 1)
                <x-gallery :media="$category->getMedia()" />
            @else
                <img src="{{ $category->getFirstMediaUrl() }}" alt="{{ $category->meta_description }}"/>
            @endif
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
