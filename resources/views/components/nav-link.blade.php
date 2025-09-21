@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'text-orange-700 inline-flex items-center px-5 pb-5 border-b-2 border-orange-500 text-base font-medium leading-5 text-black focus:outline-none hover:text-orange-600 focus:border-orange-800 transition duration-150 ease-in-out '
            : 'inline-flex  items-center px-5 pb-5 border-b-2 border-transparent text-base font-medium leading-5 text-black hover:text-orange-600 hover:border-orange-200 focus:outline-none  focus:border-orange-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
