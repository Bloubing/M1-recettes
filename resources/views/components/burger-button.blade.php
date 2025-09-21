<button data-collapse-toggle="navbar-hamburger" type="button"
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-white rounded-3xl hover:bg-orange-400 bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200 transition-colors duration-300 mr-4']) }}
    aria-controls="navbar-hamburger" aria-expanded="false">
    <span class="sr-only">Ouvrir le menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
    </svg>
</button>
