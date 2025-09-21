
<div wire:key="{{ $recipe->id }}" class=" group hover:bg-gray-100 bg-white first:rounded-t-md last:rounded-b-md">
    <a wire:navigate {{$attributes->merge(['class'=> "text-gray-600 hover:text-gray-600"])}} href="/recipes/{{ $recipe->url }}">
    <p class=" px-3 py-1 group-hover:text-gray-800 transition-colors duration-150">{{ $recipe->title }}</p>
    </a>
  </div>