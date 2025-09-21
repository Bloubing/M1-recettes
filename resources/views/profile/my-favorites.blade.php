<x-app-layout>
    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Mes recettes préférées </h1>

    @if ($recipes == [])
        <p class="text-center"> Vous n'avez pas encore de recette préférée ! </p>
    @else
        <div class="columns is-multiline mt-10">
            @foreach ($recipes as $recipe)
                <x-recipe-unit :recipe="$recipe" />
            @endforeach
        </div>
        </div>
    @endif
</x-app-layout>
