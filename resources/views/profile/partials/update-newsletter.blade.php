<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Newsletter
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            S'inscrire à la Newsletter hebdomadaire
        </p>
    </header>

    <form action="/newsletter" method="post" class="my-3">
        @csrf
        @method('patch')

        <div>
            @if ($user->wants_news())
                <input type="checkbox" id="newsletter" name="newsletter" value="abonnement" checked />
                <label for="newsletter" class="ml-2"> S'abonner à la newsletter</label>
            @else
                <input type="checkbox" id="newsletter" name="newsletter" value="abonnement" />
                <label for="newsletter"> S'abonner à la newsletter</label>
            @endif
        </div>
        <div>
            <x-primary-button class="mt-4">Enregistrer</x-primary-button>
        </div>

    </form>

</section>
