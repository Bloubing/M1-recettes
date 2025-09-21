<x-app-layout>

    <div class="border rounded flex flex-col p-4 space-y-3 bg-orange-50">
        <form class="flex flex-col space-y-2" method="post" action="/recipes/" enctype="multipart/form-data">
            @csrf

            <div>
                <h2 class="font-semibold">Partagez votre recette incroyable !</h2>
            </div>

            <x-input-label for="title">Titre</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="title" id="title" required
                value="{{ old('title') }}" />
            @error('title')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="servings">Nombre de personnes</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="servings" id="servings" required
                value="{{ old('servings') }}" />
            @error('servings')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="content">Contenu</x-input-label>
            <x-textarea class=" p-2 rounded" name="content" required>{{ old('content') }}</x-textarea>
            @error('content')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="ingredients">Ingrédients</x-input-label>
            <div class="flex flex-wrap gap-4">
                @for ($i = 0; $i < 6; $i++)
                    <div class="flex flex-row space-x-8" name="ingredients">
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][amount]"
                            name="ingredients[{{ $i }}][amount]" value="" placeholder="quantité" />
                        @error("ingredients[{{ $i }}]['amount']")
                            <x-input-error :messages="$message" />
                        @enderror
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][unit]"
                            name="ingredients[{{ $i }}][unit]" value="" placeholder="unité" />
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][name]"
                            name="ingredients[{{ $i }}][name]" value="" placeholder="ingrédient" />
                        @error("ingredients[{{ $i }}]['name']")
                            <x-input-error :messages="$message" />
                        @enderror
                    </div>
                @endfor
            </div>
            @error('ingredients')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="price">Prix</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="price" id="price" required
                value="{{ old('price') }}" />
            @error('price')
                <x-input-error :messages="$message" />
            @enderror



            <x-input-label for="image_files">Images</x-input-label>
            <input type="file" multiple name="image_files[]" id="image_files" />
            @foreach ($errors->get('image_files.*') as $error)
                <x-input-error :messages="$error" />
            @endforeach

            <x-input-label for="tags">Tags</x-input-label>
            <select name="tag1">
                @foreach ($main_tags as $main_tag)
                    <option value="{{$main_tag->name}}">{{ $main_tag->name }}</option>

                @endforeach

            </select>
            @error('tag1')
                <x-input-error :messages="$message" />
            @enderror
            <!--             <x-text-input class=" p-2 rounded" type="text" name="tag1" id="tag1" value="{{ old('tag1') }}" />
 -->
            <x-text-input class=" p-2 rounded" type="text" name="tag2" id="tag2" value="{{ old('tag2') }}" />
            <x-text-input class=" p-2 rounded" type="text" name="tag3" id="tag3" value="{{ old('tag3') }}" />
            @error('tags')
                <x-input-error :messages="$message" />
            @enderror

            <select name="status">
                <option value="draft">Enregistrer brouillon</option>
                <option value="published">Publier</option>
            </select>

            </select>
            <div class="flex justify-between mt-5">

                <x-secondary-link-button href="/recipes/">Annuler</x-secondary-link-button>
                <x-primary-button class="cursor-pointer rounded" type="submit">Envoyer</x-primary-button>
            </div>

        </form>
    </div>



</x-app-layout>