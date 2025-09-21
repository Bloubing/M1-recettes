<div class="mb-3 w-9/12 mx-auto ">
    <div class="flex flex-grow items-center mt-10  space-x-1">
        <x-sort-by :type="$type" />
        <form wire:submit class="flex-grow h-10">
            {{-- Search bar --}}
            <div class="w-full mb-2">
                <div class="field has-addons w-full flex">
                    <div class="control flex-grow w-full">
                        <x-text-input wire:model.live.defer="searchText" class="input w-full border-gray-900 border"
                            type="text" placeholder="Rechercher..." aria-label="Rechercher" />
                    </div>

                </div>
            </div>
        </form>

    </div>
    @if (strlen($searchText) >= 2)
        <div wire:transition.in.duration.200ms class="relative mt-4">
            <livewire:search-results :results="$results" :type="$type" />
        </div>
    @endif
</div>
