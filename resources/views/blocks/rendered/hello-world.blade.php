<div class="flex items-center gap-6">
    <div class="text-5xl">
        @php
            echo match($name) {
                'robin' => '🐤',
                'ivy' => '🥀',
                'joker' => '🤡',
                default => '🦇'
            }
        @endphp
    </div>
    <div>
        <p>Name: {{ $name }}</p>
        <p style="color: {{ $color }};">Color: {{ $color }}</p>
        <p>Side: {{ $side ?? 'Good' }}</p>
    </div>
</div>
