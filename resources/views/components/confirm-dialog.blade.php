@props([
'headTitle',
'modalAction',
'question',
'successAction'
])

<div class="fixed inset-0 bg-black/20" x-show="{{ $modalAction }}" x-cloak>
    <div class="flex justify-center mt-20">
        <div {{ $attributes->merge(['class' => 'bg-white w-[30rem] mt-10 p-5 rounded-md']) }}
            x-show="{{ $modalAction }}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform scale-50 opacity-0"
            x-transition:enter-end="transform scale-100 opacity-100"
            x-transition:leave="transition ease-out duration-300"
            x-transition:leave-start="transform scale-100 opacity-100"
            x-transition:leave-end="transform scale-50 opacity-0"
            >
            <section class="flex items-center justify-between">
                <h1 class="text-gray-500">Confirm</h1>
                <button @click="{{ $modalAction }} = false" class="text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                        <path class="fill-current"
                            d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                    </svg>
                </button>
            </section>

            <main class="grid place-content-center mt-5 text-center leading-4">
                <h1 class="font-semibold">{{ $headTitle }}</h1>
                <p class="text-gray-500">Are you sure you want to {{ $question }}</p>
            </main>

            <div class="flex items-center justify-end space-x-2 mt-7">
                <x-page-button @click="{{ $modalAction }} = false" textValue="Cancel" class="border"/>
                <x-page-button wire:click="{{ $successAction }}" textValue="Confirm, delete office staff" class="bg-red-600 text-white"/>
            </div>
        </div>
    </div>
</div>