<div>
    @if (!$recipe->isFavored())
        <form action="/favorites" method="post">
            @csrf
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
            <input type="hidden" name="recipe_url" value="{{ $recipe->url }}">
            <x-secondary-button class="cursor-pointer rounded ml-3 mt-[1.4rem]" type="submit"><i
                    class="fa-regular fa-heart" style="color: #a51d2d;"></i></x-secondary-button></i>

        </form>
    @else
        <form action="/favorites/{{ $recipe->userFavorite()->id }}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
            <input type="hidden" name="recipe_url" value="{{ $recipe->url }}">
            <x-secondary-button class="cursor-pointer rounded ml-3 mt-[1.4rem]" type="submit"><i
                    class="fa-solid fa-heart" style="color: #a51d2d;"></i></x-secondary-button></i>

        </form>
    @endif
</div>
