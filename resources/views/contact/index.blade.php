<x-app-layout>

    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Messages reçus</h1>


    @foreach ($contacts as $contact)
        <div class="is-4 p-5 shadow-md rounded-md m-3 mb-4">

            <div class="text-sm">
                <span>{{ $contact->created_at->translatedFormat('j M Y à H:i') }} par</span>
                <a href="mailto:{{ $contact->email }}" class="text-sm font-medium text-blue-400">{{ $contact->email }}</a>
            </div>
            <h1 class="mt-2 mb-2 is-size-4 is-size-5-mobile has-text-weight-bold">{{ $contact->objet }}</h1>
            <p class=" has-text-grey">{{ $contact->contenu }}</p>
        </div>
    @endforeach
</x-app-layout>
