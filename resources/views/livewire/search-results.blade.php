@props(['type'])

<div>
    <div class="w-full absolute text-left border rounded-md flex flex-col ">

        @if (count($results) == 0)
            <div class="px-3 py-1">
                Aucun résultat trouvé.
            </div>
        @else
            <div>
                @if ($type == 'Tags')
                    @foreach ($results as $tag)
                        <x-tag-result :tag="$tag" />
                    @endforeach
                @elseif ($type == 'Ingrédients')
                    @foreach ($results as $ingredient)
                        <x-ingredient-result :ingredient="$ingredient" />
                    @endforeach
                @elseif ($type == 'Utilisateurs')
                    @foreach ($results as $user)
                        <x-user-result :user="$user" />
                    @endforeach
                @else
                    @foreach ($results as $recipe)
                        <x-recipe-result :recipe="$recipe" />
                    @endforeach
                @endif

            </div>

        @endif
    </div>
</div>
