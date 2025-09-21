<x-app-layout>

    <div class="bg-orange-50 border rounded flex flex-col p-4 space-y-3">
        <form class="flex flex-col space-y-2" method="post" action="/recipes/{{ $recipe->url }}"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <x-input-label for="title">Titre</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="title" id="title" required
                value="{{ $recipe->title }}" />
            @error('title')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="content">Contenu</x-input-label>
            <x-textarea class=" p-2 rounded" name="content" required>{{ $recipe->content }}</x-textarea>

            @error('content')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="ingredients">Ingrédients</x-input-label>
            <div class="flex flex-wrap gap-4">
                @foreach ($recipe->ingredients as $index => $ingredient)
                    <div class="flex flex-row space-x-4">
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $index }}][amount]"
                            name="ingredients[{{ $index }}][amount]" value="{{ $ingredient->pivot->amount }}" />
                        @if ($ingredient->pivot->unit == null) 
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $index }}][unit]"
                            name="ingredients[{{ $index }}][unit]" value="{{ $ingredient->pivot->unit }}" placeholder="unité" />
                        @else
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $index }}][unit]"
                            name="ingredients[{{ $index }}][unit]" value="{{ $ingredient->pivot->unit }}" />
                        @endif
                        <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $index }}][name]"
                            name="ingredients[{{ $index }}][name]" value="{{ $ingredient->name }}" />
                    </div>
                @endforeach
                <!-- Boite/s vide/s si nécessaire -->
                @for ($i = count($recipe->ingredients); $i < 6; $i++)
                    <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][amount]"
                        name="ingredients[{{ $i }}][amount]" value="" placeholder="quantité" />
                    <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][unit]"
                        name="ingredients[{{ $i }}][unit]" value="" placeholder="unité" />
                    <x-text-input class="p-2 rounded" type="text" id="ingredients[{{ $i }}][name]"
                        name="ingredients[{{ $i }}][name]" value="" placeholder="ingrédient" />
                @endfor
            </div>
            @error('ingredients')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="price">Prix</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="price" id="price" required
                value="{{ $recipe->price }}" />
            @error('price')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="image_files">Images ({{ $recipe->files->count() }} publiées)</x-input-label>
            <input type="file" multiple name="image_files[]" id="image_files" />
            @foreach ($errors->get('image_files.*') as $error)
                <x-input-error :messages="$error" />
            @endforeach

            <x-input-label for="tags">Tags</x-input-label>
            <div class="flex flex-row space-x-2">
                @foreach ($tags as $index => $tag)
                    @if ($index > 0)
                        <x-text-input class=" p-2 rounded" type="text" id="tags[{{ $index }}]" name="tags[{{ $index }}]"
                            value="{{ $tag }}" />
                    @else
                        <select name="tags[{{ $index }}]">
                            @foreach ($main_tags as $main_tag)
                                <option value="{{$main_tag->name}}">{{ $main_tag->name }}</option>

                            @endforeach
                        </select>
                        @error('tags[{{ $index }}]')
                            <x-input-error :messages="$message" />
                        @enderror
                    @endif
                @endforeach
                <!-- Boite/s vide/s si nécessaire -->
                @for ($i = count($tags); $i < 3; $i++)
                    <x-text-input class=" p-2 rounded" type="text" id="tags[{{ $i }}]" name="tags[{{ $i }}]" value="" />
                @endfor
            </div>
            @error('tags')
                <x-input-error :messages="$message" />
            @enderror

            <select name="status">
                <option value="{{ $recipe->status }}">
                    @if ($recipe->status == 'draft')
                        Enregistrer le brouillon
                    @else
                        Publier la recette
                    @endif
                </option>
                <option @if ($recipe->status == 'draft') value="published" @else value="draft" @endif>
                    @if ($recipe->status == 'draft')
                        Publier la recette
                    @else
                        Enregistrer le brouillon
                    @endif
                </option>
            </select>
            @error('status')
                <x-input-error :messages="$message" />
            @enderror

            <div class="flex justify-between mt-5">

                <div>
                    @can('delete', $recipe)
                        <x-delete-button>Supprimer</x-delete-button>
                    @endcan
                </div>

                <div class="flex items-center gap-6">
                    <x-secondary-link-button href="/recipes/{{ $recipe->url }}">Annuler</x-secondary-link-button>
                    <x-primary-button class="cursor-pointer rounded" type="submit">Enregistrer</x-primary-button>
                </div>
            </div>


        </form>
    </div>


    <form id="delete-form" method="POST" action="/recipes/{{ $recipe->url }}" class="hidden">
        @csrf
        @method('delete')
    </form>

</x-app-layout>
