@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end space-x-3">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="bg-orange-100 inline-flex items-center px-4 py-2  rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm  focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        @else
            <x-primary-link-button href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </x-primary-link-button>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <x-primary-link-button href="{{ $paginator->nextPageUrl() }}" rel="next">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </x-primary-link-button>
        @else
            <span
                class="bg-orange-100 inline-flex items-center px-4 py-2  rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none  disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        @endif
    </nav>
@endif
