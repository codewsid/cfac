@props([
    'headTitle',
    'modalAction'
])

<div class="fixed inset-0 bg-black/20" x-show="{{ $modalAction }}" x-cloak
    >
    <div class="flex justify-center">
        <div 
            {{ $attributes->merge(['class' => 'bg-white w-[30rem] mt-10 p-5 rounded-md']) }}
            x-show="{{ $modalAction }}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform scale-50 opacity-0"
            x-transition:enter-end="transform scale-100 opacity-100"
            x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="transform scale-100 opacity-100"
            x-transition:leave-end="transform scale-50 opacity-0"
            >
            <section class="flex items-center justify-between">
                <h1 class="text-gray-500">{{ $headTitle }}</h1>
                <button @click="{{ $modalAction }} = false" class="text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                        <path class="fill-current"
                            d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                    </svg>
                </button>
            </section>

            <div class="h-[1px] w-full bg-gray-200 my-2.5"></div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>