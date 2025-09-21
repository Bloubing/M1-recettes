<x-app-layout>
    <div class="flex flex-col">
        <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Recettes avec</h1>
        @if ($tag->isDefaultTag())
            <x-primary-tag-title :tag="$tag" />
        @else
            <x-tag-title :tag="$tag" />
        @endif
    </div>
    <div class="columns is-multiline mt-20">
        @foreach ($tag->recipes->sortByDesc('created_at') as $recipe)
            <x-recipe-unit :recipe="$recipe" />
        @endforeach
    </div>

    <x-secondary-link-button class="mt-4" href="{{ url()->previous() }}">Retour</x-secondary-link-button>

</x-app-layout>
