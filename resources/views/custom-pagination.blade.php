<div class="flex items-center justify-between text-sm mt-2 text-gray-500 select-none">
    @if($paginator->hasPages())
    <p>Showing {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} out of {{ $paginator->total() }} items

    <nav role="navigation" class="flex items-center space-x-5">
        <span>
            @if ($paginator->onFirstPage())
            <button class="flex cursor-auto items-center space-x-1 text-zinc-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span>Prev</span>
            </button>
            @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                class="cursor-pointer text-kgreen flex items-center space-x-1" id="previous">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="font-bold">Prev</span>
            </button>
            @endif
        </span>

        <!-- Numbers -->
        @foreach ($elements as $element)
        <menu class="flex items-center space-x-3">
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="bg-kgreen px-2 py-1 text-white rounded" aria-current="page"><span
                    class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item d-none d-md-block"><button type="button" class="page-link"
                    wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
            @endif
            @endforeach
            @endif
        </menu>
        @endforeach

        <!-- Next Page Condition-->
        <span>
            @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                class="cursor-pointer text-kgreen flex items-center space-x-1" id="next">
                <span class="font-bold">Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            @else
            <button class="flex cursor-auto items-center space-x-1 text-zinc-400">
                <span>Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            @endif
        </span>
    </nav>
    @endif
</div>