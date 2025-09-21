<nav class="lg:hidden  bg-white">

    <div class="max-w-screen-xl flex flex-wrap items-center  mx-auto p-4">
        <div class="navbar-brand">

            <a href="{{ route('home') }}" class="group navbar-item pl-7 pr-5 pt-0 ">
                <x-application-logo width=2rem height=2rem />
                <span
                    class="font-semibold pl-4 text-2xl text-gray-700 motion-preset-slide-right-md motion-duration-2000 group-hover:text-orange-500">Recettes</span>
            </a>

        </div>


        @auth
            <!-- Settings Dropdown -->
            <x-settings-dropdown class="flex items-center ml-auto" />
            <x-burger-button />

        @endauth
        @guest
            <x-burger-button class="ml-auto" />
        @endguest

        <div class="hidden w-full" id="navbar-hamburger">
            <ul class="flex flex-col font-medium mt-4 rounded-2xl bg-orange-50">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 text-white hover:text-white bg-orange-500 hover:bg-orange-600 rounded-sm transition-colors duration-300"
                        aria-current="page">Accueil</a>
                </li>
                @guest
                    <li>
                        <a href="{{ route('login') }}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">
                            Connexion
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">
                            Inscription
                        </a>
                    </li>
                @endguest
                <li>
                    <a href="/recipes"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">Recettes</a>
                </li>
                @auth
                    <li>
                        <a href="{{ route('recipes.create') }}"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">Ajouter
                            une recette</a>
                    </li>
                    <li>
                        <a href="/profile/myfavorites"
                            class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">Favoris</a>
                    </li>
                @endauth
                <li>
                    <a href="{{ route('contact.create') }}"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-orange-100 transition-colors duration-300">Contact</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
