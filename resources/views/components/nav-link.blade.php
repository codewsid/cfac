@props(['active'])

@php
$classes = ($active ?? false)
? 'px-3.5 mx-2 rounded bg-kgreen  py-2.5 flex items-center text-base font-medium text-white transition'
: 'px-3.5 mx-2 py-2.5 flex items-center text-base font-medium hover:text-kgreen text-gray-600 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>