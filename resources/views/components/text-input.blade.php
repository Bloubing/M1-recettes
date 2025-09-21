@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border  focus:border-orange-300 focus:ring-orange-500 rounded-md shadow-sm']) }}>
