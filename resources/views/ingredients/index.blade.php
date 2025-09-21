<x-app-layout>
    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Liste des Ingrédients</h1>

    <div class=" flex flex-wrap">
        @foreach ($ingredients as $ingredient)
            <div class="mt-4">
                <x-ingredient :ingredient="$ingredient" />
            </div>
        @endforeach
    </div>

</x-app-layout>
