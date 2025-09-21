<div class="column sm:is-3 md:is-3 lg:is-5">


    <div
        class="group  hover:bg-orange-50  hover:scale-105 bg-white rounded-xl transition duration-150 ease-in shadow-md shadow-orange-50 hover:shadow-orange-200 pt-2 mb-5 mx-1 px-1">
        <a {{ $attributes->merge(['class' => 'text-gray-600 hover:text-gray-600']) }}
            href="/recipes/{{ $recipe->url }}">

            <div class="flex flex-col items-center">

                <span
                    class="has-text-grey-dark text-sm">{{ $recipe->created_at->translatedFormat('j M Y à H:i') }}</span>
                <x-recipe-review :recipe="$recipe" />


                <div>
                    @if ($recipe->files->isNotEmpty())
                        <img src="{{ $recipe->files->first()->image_url }}" alt="Image de la recette {{ $recipe->title }}"
                            class="mt-5 mb-3 w-[calc(13vw+5.5rem)] h-[calc(13vw+5.5rem)]  object-cover max-w-2xl min-w-2xl rounded-lg">
                    @else
                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.istockphoto.com%2Fvectors%2Fkitchen-utensils-icon-crossed-vector-id959406424%3Fk%3D6%26m%3D959406424%26s%3D170667a%26w%3D0%26h%3Dsg3ND36Wre73QJ6w7sm94kmFndn8wLfzmtzlQCcwwfI%3D&f=1&nofb=1&ipt=4ab28e80a910b9743a24bed20bccd3aee16be7b71644d40916542f498c068c87&ipo=images"
                            alt="Image de recette par défaut"
                            class="mt-5 mb-3 w-[calc(13vw+5.5rem)] h-[calc(13vw+5.5rem)]  object-cover max-w-2xl min-w-2xl rounded-lg">
                    @endif
                </div>


                <div class="text-center">
                    <h2
                        class="group-hover:text-gray-500 transition-colors mb-4 duration-300 is-size-6 has-text-weight-bold">
                        {{ $recipe->title }}</h2>
                    <div class="h-12">

                        <div class="flex">
                            @if ($recipe->tags->isNotEmpty())
                                @foreach ($recipe->tags->sortBy('name') as $tag)
                                    @if ($tag->isDefaultTag())
                                        <div>
                                            <x-primary-tag :tag="$tag" />
                                        </div>
                                    @else
                                        <div>

                                            <x-tag :tag="$tag" />

                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>

    </div>
    </a>

</div>
