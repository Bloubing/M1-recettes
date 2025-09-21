<div class="p-6 overflow-hidden shadow  mx-auto max-w-[86rem]">
    <div>

        <a href="/users/{{ $comment->user->id }}" class="flex space-x-3">
            <img src="{{ $comment->user->avatar }}" alt="Photo de profil de {{ $comment->user->name }}" class="w-9 h-9">
            <span
                class="text-lg  mt-1 font-bold hover:text-orange-500 transition duration-150">{{ $comment->user->name }}</span>
        </a>
        @if ($type == 'answer')
            {{-- Le commentaire est une réponse --}}
            <div class="italic mt-3">
                <span>En réponse à </span>
                <a class="font-semibold hover:text-orange-500 transition duration-150"
                    href="/users/{{ $comment->parent->user->id }}">{{ $comment->parent->user->name }}</a>
            </div>
        @endif

        {{-- Stars --}}
        <div class="flex items-center mt-1 mb-4 space-x-1">


            @if (!is_null($comment->rating()))
                @for ($i = 0; $i < $comment->rating(); $i++)
                    <svg class="w-6 h-6 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path
                            d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                    </svg>
                @endfor

                @for ($i = 0; $i < 5 - $comment->rating(); $i++)
                    <svg class="w-6 h-6 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <path
                            d="M234.29,114.85l-45,38.83L203,211.75a16.4,16.4,0,0,1-24.5,17.82L128,198.49,77.47,229.57A16.4,16.4,0,0,1,53,211.75l13.76-58.07-45-38.83A16.46,16.46,0,0,1,31.08,86l59-4.76,22.76-55.08a16.36,16.36,0,0,1,30.27,0l22.75,55.08,59,4.76a16.46,16.46,0,0,1,9.37,28.86Z" />
                    </svg>
                @endfor

            @endif



        </div>

    </div>



    @if ($comment->reportcomments->count() > 9)
        <p>[Ce commentaire est indisponible car de nombreuses personnes l'ont signalé.]</p>
    @else
        <p>{{ $comment->content }}</p>
    @endif

    <div class="flex justify-between items-center mt-4 space-x-4">
        <div>

            <time datetime="2021-02-18"
                class="text-sm">{{ $comment->created_at->translatedFormat('j M Y à H:i') }}</time>
        </div>

        @auth
            <div class="flex flex-col space-y-2">
                <x-primary-link-button href="/comments/{{ $comment->id }}/reply">Répondre</x-primary-link-button>
                @can('edit', $comment)
                    <x-secondary-link-button href="/comments/{{ $comment->id }}/edit">Modifier</x-secondary-link-button>
                @endcan

                @cannot('edit', $comment)
                    @if (!$comment->isReported())
                        <form action="/reportcomments" method="post">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <x-danger-button type="submit" class="px-5">Signaler</x-danger-button>

                        </form>
                    @endif
                @endcannot
            </div>
        @endauth

    </div>
</div>
