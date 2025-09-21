<x-app-layout>

    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif

    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Contactez-nous</h1>

    <div class=" rounded-xl flex flex-col p-4 space-y-3 bg-orange-50">
        <form class="flex flex-col space-y-2" method="post" action="/contact">
            @csrf
            <x-input-label for="email">Email</x-input-label>
            <x-text-input class=" p-2 rounded" name="email" id="email" placeholder="johndoe@example.com"
                value="{{ old('email') }}" required />

            @error('email')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="objet">Objet</x-input-label>
            <x-text-input class=" p-2 rounded" type="text" name="objet" id="objet" value="{{ old('objet') }}"
                required />
            @error('objet')
                <x-input-error :messages="$message" />
            @enderror

            <x-input-label for="contenu">Contenu</x-input-label>
            <x-textarea class="p-2  rounded " name="contenu" placeholder="Dites-nous en plus..."
                required>{{ old('contenu') }}</x-textarea>
            @error('contenu')
                <x-input-error :messages="$message" />
            @enderror
            <div class="flex justify-end mt-5">
                <x-primary-button class="cursor-pointer rounded" type="submit">Envoyer</x-primary-button>
            </div>

        </form>
    </div>

</x-app-layout>
