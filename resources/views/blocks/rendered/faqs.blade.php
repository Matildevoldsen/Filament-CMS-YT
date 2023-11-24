<div id="accordion-collapse" data-accordion="collapse">
    @foreach($accordions as $key => $accordion)
        <h2 id="accordion-collapse-heading-{{$key}}">
            <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                    data-accordion-target="#accordion-collapse-body-{{$key}}" aria-expanded="true"
                    aria-controls="accordion-collapse-body-{{$key}}">
                <span>{{ $accordion['question'] }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-{{$key}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$key}}">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                {!! $accordion['answer'] !!}
            </div>
        </div>
    @endforeach
</div>
