{{-- Burger menu pour petits écrans --}}
<x-burger-menu />

{{-- Navbar traditionnelle --}}
<nav class="hidden lg:block navbar py-4">
    <div class="container">
        <div class="navbar-brand">

            <a href="{{ route('home') }}" class="navbar-item pl-2 pr-5 pt-0">
                <x-application-logo width=2rem height=2rem />
            </a>

        </div>
        <div class="navbar-menu">
            <div class="navbar-start pt-3">
                <x-nav-link :active="request()->routeIs('home')" href="{{ route('home') }}">Accueil</x-nav-link>
                <x-nav-link :active="request()->routeIs('recipes.*')" href="/recipes">Recettes</x-nav-link>
                @auth
                    <x-nav-link :active="request()->routeIs('profile.favorites')" href="/profile/myfavorites">Favoris</x-nav-link>
                @endauth
                <x-nav-link :active="request()->routeIs('contact.*')" href="/contact/create">Contact</x-nav-link>
            </div>


            <div class=" flex items-center space-x-4">
                @guest
                    <x-secondary-link-button class="py-4" href="{{ route('login') }}">Connexion</x-secondary-link-button>
                    <x-primary-link-button class="py-4" href="{{ route('register') }}">Inscription</x-primary-link-button>
                @endguest

                @auth

                    <!-- Settings Dropdown -->
                    <x-settings-dropdown class="hidden sm:flex sm:items-center sm:ms-6" />



                    <x-primary-link-button class="py-4" href="/recipes/create">Ajouter une
                        recette</x-primary-link-button>

                @endauth
            </div>





        </div>
    </div>
</nav>
