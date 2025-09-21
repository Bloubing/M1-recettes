<x-app-layout>

    <div class="bg-orange-50 mt-5 mb-5  flex flex-col p-6 overflow-hidden shadow ">

        <form class="flex flex-col space-y-2" method="post" action="/comments/{{ $comment->id }}">
            @csrf
            @method('patch')


            <x-input-label for="content">Contenu</x-input-label>
            <x-textarea class=" p-2 rounded" name="content" id="content" required>{{ $comment->content }}</x-textarea>
            @error('content')
                <x-input-error :messages="$message" />
            @enderror

            <div class="flex justify-between mt-5">
                <div>
                    @can('delete', $comment)
                        <x-delete-button form="delete-form">Supprimer</x-delete-button>
                    @endcan
                </div>
                <div class="flex items-center gap-6">
                    <x-secondary-link-button href="/recipes/{{ $recipe->url }}"
                        type="text">Annuler</x-secondary-link-button>
                    <x-primary-button class="cursor-pointer rounded" type="submit">Enregistrer</x-primary-button>
                </div>
            </div>
        </form>
    </div>

    <form id="delete-form" method="POST" action="/comments/{{ $comment->id }}" class="hidden">
        @csrf
        @method('delete')
    </form>

</x-app-layout>
