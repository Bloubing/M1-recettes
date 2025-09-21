<div x-data="{
    dropdownOpen: false
}" class="relative">

    <button @click="dropdownOpen=true"
        class="bg-orange-500 text-white font-semibold text-sm inline-flex items-center justify-center h-10 w-[8em] py-[1.1rem] px-2 transition-colors  duration-200  border rounded-md  hover:bg-orange-400 hover:scale-30 hover:-translate-y-[1px]  active:bg-orange-400 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
        {{ $type }} ▼
    </button>

    <div x-show="dropdownOpen" @click="dropdownOpen=false" @click.away="dropdownOpen=false"
        x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2"
        x-transition:enter-end="translate-y-0" class="absolute top-0 z-50 w-56 mt-12 -translate-x-1/2 left-1/2" x-cloak>

        {{-- On change le type de tri selon l'option cliquée --}}
        <div class="p-1 mt-1 bg-white rounded-md shadow-md  text-neutral-700">
            <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
            <a wire:click="setType('Recettes')"
                class="relative flex cursor-default select-none  hover:font-medium duration-200 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                <span>Recettes</span>
            </a>
            <a wire:click="setType('Tags')"
                class="relative flex cursor-default select-none  hover:font-medium items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                <span>Tags</span>
            </a>
            <a wire:click="setType('Ingrédients')"
                class="relative flex cursor-default select-none  hover:font-medium items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                <span>Ingrédients</span>
            </a>
            <a wire:click="setType('Utilisateurs')"
                class="relative flex cursor-default select-none  hover:font-medium items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                <span>Utilisateurs</span>
            </a>
        </div>
    </div>
</div>
