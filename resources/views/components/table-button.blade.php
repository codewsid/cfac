@props([
    'type' => 'edit'
])

@php
    if($type == 'edit'){
        $classes = 'bg-kgreen/10 text-kgreen font-semibold px-3 rounded hover:bg-kgreen/20';
    }
    else if($type == 'remove'){
        $classes = 'bg-red-500/10 text-red-500 font-semibold px-3 rounded hover:bg-red-500/20';
    }
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $type }}</button>