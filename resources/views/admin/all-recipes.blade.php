<x-app-layout>

    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif

    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Liste des recettes</h1>

    <div class="container p-2 mx-auto sm:p-4">
        <div class="overflow-x-auto">
            <table class="w-full p-6 whitespace-nowrap ">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col class="w-5">
                </colgroup>
                <thead>
                    <tr class="bg-orange-200">
                        <th class="p-3">Nom</th>
                        <th class="p-3">Note</th>
                        <th class="p-3">Commentaires</th>
                        <th class="p-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="border-b">
                    @foreach ($recipes as $recipe)
                        <tr class="bg-orange-50">
                            <td class="px-3 py-2 ">
                                <a class="hover:text-orange-500 transition duration-150"
                                    href="/recipes/{{ $recipe->url }}">{{ $recipe->title }}</a>
                            </td>
                            <td class="px-3 py-2">
                                @if ($recipe->ratings->count() > 0)
                                    <p>{{ $recipe->averageRating() }}</p>
                                @else
                                    <p> Aucun avis</p>
                                @endif
                            </td>
                            <td class="px-3 py-2">{{ $recipe->comments->count() }}</td>
                            <td class="px-3 py-2">
                                <x-edit-button type="button" title="Open details" class="p-1 rounded-full text-black"
                                    :content="$recipe" edithref="/recipes/{{ $recipe->url }}/edit"
                                    deleteaction="/recipes/{{ $recipe->url }}">
                                    <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current">
                                        <path
                                            d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z">
                                        </path>
                                    </svg>
                                </x-edit-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-10">
        {{ $recipes->links() }}
    </div>

    <x-secondary-link-button class="mt-5" href="/admin">Retour</x-secondary-link-button>


</x-app-layout>
