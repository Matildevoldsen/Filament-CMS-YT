<div class="bg-blue-500">
    <ul>
        @foreach($accordions as $accordion)
            <li>{{ $accordion['question'] }}</li>
        @endforeach
    </ul>
</div>
