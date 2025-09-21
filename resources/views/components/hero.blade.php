<section>
    <div class="container flex flex-col justify-center p-6 mx-auto sm:py-12 lg:py-24 lg:flex-row lg:justify-between">
        <div class="flex items-center justify-center p-6 mt-8 lg:mt-0 h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
            <img src="https://simply-delicious-food.com/wp-content/uploads/2022/09/Breakfast-board28.jpg"
                alt="Une recette de cuisine"
                class="object-contain h-72 rounded-full shadow-sm sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
        </div>
        <div
            class="flex flex-col justify-center px-6 pb-6 pt-5 text-center rounded-sm lg:max-w-md xl:max-w-lg lg:text-left">
            <h1
                class="lg:text-5xl md:text-5xl text-4xl font-bold leading-none intersect:motion-opacity-in-0 lg:intersect:motion-translate-y-in-100 intersect:motion-blur-in-sm intersect:motion-duration-1000">
                Des
                recettes
                <span class="text-orange-500">savoureuses</span> et faciles
            </h1>
            <p class="mt-6 mb-8 text-lg sm:mb-12">Recettes est une plateforme de partage de recettes
                <br class="hidden md:inline lg:hidden">en ligne qui ne cesse de grandir depuis 2019.
            </p>
            <div
                class="flex flex-col space-y-4 sm:items-center sm:justify-center sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start">
                <x-secondary-link-button rel="noopener noreferrer" href="{{ route('register') }}"
                    class="px-6 py-5 text-lg font-semibold rounded intersect:motion-preset-fade-lg motion-duration-2000 intersect-once">Découvrir
                </x-secondary-link-button>
                <x-primary-link-button rel="noopener noreferrer" href="/register"
                    class="px-6 py-5 text-lg font-semibold rounded intersect:motion-preset-fade-lg motion-duration-2000 intersect-once">S'incrire</x-primary-link-button>
            </div>
        </div>
    </div>
</section>
