<x-app-layout>

    <div class="container">
        <div class="mb-6 columns is-multiline is-centered">
            <div class="column is-8 has-text-centered">

                <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Recettes</h1>
                <x-home-title>Le meilleur de la cuisine</x-home-title>

                <livewire:search />


            </div>

        </div>

        @yield('content')




    </div>

    <h2 class="is-size-3 has-text-weight-bold text-center">Les plus récentes</h2>

    <div class="columns is-multiline mt-10">
        @foreach ($recipes as $recipe)
            <x-recipe-unit :recipe="$recipe" href="/recipes/{{ $recipe->url }}" />
        @endforeach
    </div>

</x-app-layout>
