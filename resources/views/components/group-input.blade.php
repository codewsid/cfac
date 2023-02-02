@props([
    'type' => 'text',
    'label',
    'placeholder',
    'name',
    'model',
    'disable' => 'false',
])

<section class="flex flex-col">
    <label for="{{ $name }}" class="font-semibold">{{ $label }}</label>
    <input {{ $disable == 'disabled' ? 'disabled' : '' }} type="{{ $type }}" wire:model="{{ $model }}"
        name="{{ $name }}" id="{{ $name }}" class="rounded-md border border-gray-200 mt-1"
        placeholder="{{ $placeholder }}">
</section>
