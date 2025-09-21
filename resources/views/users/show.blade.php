<x-app-layout>
    @auth

        @if (Auth()->user()->isAdmin())
            <form class="space-y-2 mb-10" method="post" action="/admin/usersupdate">
                @method('patch')
                @csrf
                <p>{{ $user->name }} est actuellement :
                    @if ($user->roles->count() == 0)
                        utilisateur.rice
                    @else
                        @foreach ($user->roles as $role_user)
                            {{ $role_user->name }}
                        @endforeach
                    @endif
                </p>
                <input type="hidden" name="user_name" value="{{ $user->name }}" />
                <label for="role">Changer de rôle :</label>
                <select name="role">
                    @foreach ($roles as $role)
                        <option value=" {{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                    <option value="user"> Utilisateur·ice</option>
                </select>
                <x-primary-button class="cursor-pointer rounded" type="submit">Valider</x-primary-button>
            </form>
        @endif
    @endauth

    <img src="{{ $user->avatar }}" class="mx-auto w-[10rem] h-[10rem] mb-10">

    <h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold text-center">{{ $user->name }}</h1>


    <h2 class="mt-2 mb-2 is-size-3 is-size-4-mobile has-text-weight-bold text-center">Recettes publiées</h2>

    @if ($recipes->count() == 0)
        <p class="mb-5 mt-10 text-center">Aucune recette trouvée.</p>
    @else
        <div class="columns is-multiline mt-20">
            @foreach ($recipes as $recipe)
                <x-recipe-unit :recipe="$recipe" href="/recipes/{{ $recipe->url }}" />
            @endforeach
        </div>
    @endif

    <x-secondary-link-button class="mt-4" href="{{ url()->previous() }}">Retour</x-secondary-link-button>

</x-app-layout>