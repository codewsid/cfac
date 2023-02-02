@props(['title'])

<h1 {{ $attributes->merge(['class' => 'font-bold uppercase text-xl']) }}>{{ $title }}</h1>