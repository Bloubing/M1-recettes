<x-app-layout>

    <div class="bg-gray-100 mt-5 mb-5  flex flex-col p-6 overflow-hidden shadow ">
        <h1 class="font-bold">Ajouter un commentaire</h1>
        <form class="flex flex-col space-y-2" method="post" action="/comments">
            @csrf
            <p>
                <a href="/users/{{ $parent_comment->user->id }}">Réponse à
                    <span
                        class="hover:font-semibold font-medium text-orange-500">{{ $parent_comment->user->name }}</span>
                </a>
            </p>
            <p class="italic">{{ $parent_comment->content }}</p>
            <input type="hidden" name="recipe_id" value="{{ $parent_comment->recipe->id }}">
            <input type="hidden" name="recipe_url" value="{{ $parent_comment->recipe->url }}">
            <input type="hidden" name="parent_id" value="{{ $parent_comment->id }}">

            <x-input-label for="content">Votre réponse</x-input-label>
            <x-textarea class=" p-2 rounded" name="content" required>{{ old('content') }}</x-textarea>
            @error('content')
                <x-input-error :messages="$message" />
            @enderror

            <div class="flex justify-end mt-4">

                <x-primary-button class="cursor-pointer rounded" type="submit">Envoyer</x-primary-button>
            </div>

        </form>


    </div>

</x-app-layout>
