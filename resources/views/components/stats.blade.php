<section class="p-6 ">
    <div class="container mx-auto grid justify-center grid-cols-2 gap-5 text-center ">
        <div class="flex flex-col justify-start m-2 lg:m-6">
            <div class="text-4xl font-bold leading-none lg:text-6xl">
                <x-counter :target="12000" :duration="1100">12000</x-counter>

            </div>

            <p class="text-sm sm:text-base">recettes</p>
        </div>
        <div class="flex flex-col justify-start m-2 lg:m-6">
            <div class="text-4xl font-bold leading-none lg:text-6xl">
                <x-counter :target="7500" :duration="1000">7500</x-counter>
            </div>
            <p class="text-sm sm:text-base">utilisateurs mensuels</p>
        </div>
        <div class="flex flex-col justify-start m-2 lg:m-6">
            <div class="text-4xl font-bold leading-none lg:text-6xl">
                <x-counter :target="6" :duration="900">6</x-counter>
            </div>
            <p class="text-sm sm:text-base">ans d'expérience</p>
        </div>
        <div class="flex flex-col justify-start m-2 lg:m-6">
            <div class="text-4xl font-bold leading-none lg:text-6xl">
                <x-counter :target="3" :duration="900">3</x-counter>
            </div>
            <p class="text-sm sm:text-base">minutes pour créer une recette</p>
        </div>

    </div>
</section>
