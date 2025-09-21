<a
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 hover:scale-30 hover:-translate-y-[1px] py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-400 focus:bg-orange-500 hover:text-white active:bg-orange-700 focus:outline-none transition ease-in-out duration-200']) }}>
    {{ $slot }}
</a>
