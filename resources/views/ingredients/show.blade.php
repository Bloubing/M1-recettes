<x-app-layout>
    <div class="flex flex-col">
        <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Recettes avec</h1>

        <span class=" text-xl mx-auto border-gray-800 rounded-full px-20 py-5  text-center mb-6 border-[0.1rem]">
            {{ $ingredient->name }} </span>
    </div>
    <div class="columns is-multiline mt-20">
    @foreach ($ingredient->recipes->sortByDesc('created_at') as $recipe)
        <x-recipe-unit :recipe="$recipe" />
    @endforeach
    </div>
    <x-secondary-link-button class="mt-4" href="{{ url()->previous() }}">Retour</x-secondary-link-button>

</x-app-layout>
