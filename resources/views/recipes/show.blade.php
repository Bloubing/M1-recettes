<x-app-layout>

    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif

    <div class="is-4 mb-5 mx-auto">

        <span class=" text-sm has-text-grey-dark">Publiée le
            {{ $recipe->created_at->translatedFormat('j M Y à H:i') }}
            par <a class="font-bold  text-orange-600 hover:text-orange-400 transition duration-150"
                href="/users/{{ $user->id }}">{{ $user->name }}</a></span>

        <x-recipe-review :recipe="$recipe" />

        <div class="flex">
            <h2 class=" my-3 is-size-3 is-size-4-mobile has-text-weight-bold">{{ $recipe->title }}</h2>
            @auth
                <x-heart :recipe="$recipe" />
            @endauth
        </div>



        @if (count($files) > 0)
            <x-carousel :files="$files" :recipe="$recipe" />
        @endif


        <p class="mb-4 has-text-grey max-w-[66ch] ">{{ $recipe->content }}</p>


        @if ($recipe->image_url)
            <img src="{{ $recipe->image_url }}" alt="Image de la recette {{ $recette->title }}"
                class="mt-5 mb-5 w-[20rem] h-[20rem] object-cover max-w-2xl rounded-lg shadow-lg">
        @endif

        @foreach ($recipe->ingredients as $ingredient)
            <div class="mt-2"><strong>Nombre de personnes :</strong> {{ $ingredient->pivot->servings }}</div>
        @break
    @endforeach

    <div class="mt-2"><strong>Ingrédients :</strong></div>
    <table class=" table-auto border-collapse mt-2">
        <thead class="bg-orange-500 ">
            <tr>
                <th class="text-white  border border-orange-800 px-4 py-2">Quantité</th>
                <th class="text-white border border-orange-800 px-4 py-2">Ingrédient</th>
            </tr>
        </thead>
        <tbody class="bg-orange-50">
            @foreach ($recipe->ingredients as $ingredient)
                <tr>
                    <td class="border border-orange-300 py-2 px-5 text-center">
                        {{ $ingredient->pivot->amount }} {{ $ingredient->pivot->unit }}
                    <td class="border border-orange-300  py-2 px-5 text-center"><a
                            href="/ingredients/{{ $ingredient->id }}" class="hover:text-orange-500">
                            {{ $ingredient->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-2"><strong>Prix :</strong> {{ $recipe->price }}</p>

    @if ($recipe->tags->isNotEmpty())
        <div class="mt-10">
            @foreach ($recipe->tags as $tag)
                @if ($tag->isDefaultTag())
                    <x-primary-tag :tag="$tag" />
                @else
                    <x-tag :tag="$tag" />
                @endif
            @endforeach
        </div>
    @endif

    <div class="flex justify-between mt-5 mb-10 ">
        <x-secondary-link-button href="/recipes">Retour</x-secondary-link-button>

        @auth
            @cannot('edit', $recipe)
                @if (!$recipe->isReported())
                    <form action="/reports" method="post">
                        @csrf
                        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                        <input type="hidden" name="recipe_url" value="{{ $recipe->url }}">
                        <x-danger-button type="submit">Signaler</x-danger-button>
                    </form>
                @endif
            @endcannot
        @endauth

        @can('edit', $recipe)
            <x-secondary-link-button href="/recipes/{{ $recipe->url }}/edit">Modifier</x-secondary-link-button>
        @endcan

    </div>



    <div class="border-t-4 border-orange-200"></div>



    @if (!$recipe->isRated())
        <h3 class="mt-5 mb-2 is-size-5 is-size-5-mobile has-text-weight-bold">Donnez votre avis !</h3>
        <div class="flex">

            <form action="/ratings" method="post">
                @csrf
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <input type="hidden" name="recipe_url" value="{{ $recipe->url }}">
                <div class="flex">
                    <x-stars :recipe="$recipe" />
                    <x-primary-button class="cursor-pointer rounded ml-3 mt-[1.4rem]"
                        type="submit">OK</x-primary-button>
                </div>
                @error('stars')
                    <x-input-error class="mt-3" :messages="$message" />
                @enderror
        </div>
        </form>
    @else
        <h3 class="mt-5 mb-2 is-size-5 is-size-5-mobile has-text-weight-bold">Votre avis</h3>

        <form method="post" action="/ratings/{{ $recipe->userRating()->id }}">
            @csrf
            @method('patch')
            <div class="flex">
                <x-stars :recipe="$recipe" />
                <x-secondary-button class="cursor-pointer rounded ml-3 mt-[1.4rem] font-bold"
                    type="submit">✔️</x-secondary-button>
                <x-danger-button class="cursor-pointer rounded ml-2 mt-[1.4rem]"
                    form="delete-form">✖</x-danger-button>
                @error('stars')
                    <x-input-error class="mt-3" :messages="$message" />
                @enderror
            </div>
        </form>

        <form id="delete-form" method="POST" action="/ratings/{{ $recipe->userRating()->id }}" class="hidden">
            @csrf
            @method('delete')
        </form>
    @endif


    <div>
        <h3 class="mt-5 mb-2 is-size-5 is-size-5-mobile has-text-weight-bold">Commentaires
            ({{ $recipe->comments->count() }})</h3>

        <div class="bg-orange-50 rounded-xl mt-5 mb-5  flex flex-col p-6 overflow-hidden shadow ">
            <h1 class="font-bold">Ajouter un commentaire</h1>
            <form class="flex flex-col space-y-2" method="post" action="/comments">
                @csrf

                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <input type="hidden" name="recipe_url" value="{{ $recipe->url }}">

                <x-input-label for="content">Contenu</x-input-label>
                <x-textarea class=" p-2 rounded" name="content" required>{{ old('content') }}</x-textarea>
                @error('content')
                    <x-input-error :messages="$message" />
                @enderror

                <div class="flex justify-end mt-4">
                    <x-primary-button class="cursor-pointer rounded" type="submit">Envoyer</x-primary-button>
                </div>

            </form>
        </div>


        @foreach ($comments as $comment)
            <x-comment :comment="$comment" type="recipe" />

            @if ($comment->children->count() > 0)
                @include('recursive-comments', ['comments' => $comment->children])
            @endif
        @endforeach

    </div>

</div>
</div>
</x-app-layout>
