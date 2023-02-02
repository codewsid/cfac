@props([
    'type' => 'button'
])

<button {{ $attributes->merge(['class' => 'bg-transparent']) }}>
    {{ $slot }}
</button>