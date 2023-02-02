@props([
    'placeholder',
    'model'
])

<div class="bg-white border rounded-md border-gray-300 flex items-center px-2.5 group">
    <svg class="text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
        <path class="fill-current"
            d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z" />
    </svg>
    <input type="text" {{ $attributes }}  placeholder="Search {{ $placeholder }}" {{ $attributes->merge(['class' => 'bg-transparent rounded-md border-transparent focus:border-transparent focus:ring-0 w-[30rem]']) }}>
</div>