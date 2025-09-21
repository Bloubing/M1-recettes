<x-app-layout>

    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif

    <div class="flex justify-center space-x-2 is-size-3 has-text-weight-bold text-center">
        <h2>Une idée de recette</h2>
        <div class="motion-preset-bounce motion-duration-900">?</div>
    </div>
    <livewire:search />



    <div class="columns is-multiline mt-20">
        @foreach ($recipes as $recipe)
            <x-recipe-unit :recipe="$recipe" />
        @endforeach
    </div>
    <div class="mr-5 mb-5">
        {{ $recipes->links() }}
    </div>
</x-app-layout>
