@props([
    'type' => 'button',
    'textValue',
    'wireTarget',
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center space-x-2 justify-center
    rounded-md px-4 py-2 font-medium
    shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
    sm:w-auto']) }}>
    {{ $slot }}

    <div>
        <span>{{ $textValue }}</span>
    </div>
</button>