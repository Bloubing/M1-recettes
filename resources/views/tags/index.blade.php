<x-app-layout>

    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Liste des Tags</h1>

    <div class=" flex flex-wrap">
        @foreach ($tags as $tag)
            <div class="mt-4">
                <x-tag :tag="$tag" />
            </div>
        @endforeach
    </div>

</x-app-layout>
