<x-app-layout>
    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif
    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Recettes signalées</h1>

    <div class="container p-2 mx-auto sm:p-4">
        <div class="overflow-x-auto">
            <table class="w-full p-6 whitespace-nowrap ">
                <colgroup>
                    <col>
                    <col>
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
                        <th class="p-3">Statut</th>
                        <th class="p-3">Signalements</th>
                        <th class="p-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="border-b">
                    @foreach ($reported_recipes as $recipe)
                        @if ($recipe->reports->count() > 9)
                            <tr class="bg-orange-50">
                                <td class="px-3 py-2"><a href="/recipes/{{ $recipe->url }}">{{ $recipe->title }}</a>
                                </td>
                                <td class="px-3 py-2">
                                    @if ($recipe->ratings->count() > 0)
                                        <p>{{ $recipe->averageRating() }}</p>
                                    @else
                                        <p> Aucun avis</p>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ $recipe->comments->count() }}</td>
                                <td class="py-1 mr-3"> {{ $recipe->status }}</td>
                                <td class="py-1 mr-3"> {{ $recipe->nb_Reports() }}</td>
                                <td class="px-3 py-2">
                                    <x-edit-report-button type="button" :content="$recipe" type="recipe"
                                        title="Open details" class="p-1 rounded-full text-black"
                                        edithref="/recipes/{{ $recipe->url }}/edit"
                                        deleteaction="/recipes/{{ $recipe->url }}" reportaction="/reportrecipes">
                                        <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current">
                                            <path published 1
                                                d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z">
                                            </path>
                                        </svg>
                                    </x-edit-report-button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-secondary-link-button class="mt-5" href="/admin">Retour</x-secondary-link-button>

</x-app-layout>
