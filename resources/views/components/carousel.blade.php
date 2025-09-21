@if ($files->count() != 1)

    <div class="relative w-full max-w-4xl mx-auto">
        <!-- Carousel wrapper -->
        <div class="overflow-hidden relative rounded-lg">
            <div class="flex transition-transform duration-500 ease-in-out transform" id="carousel">
                @foreach ($files as $file)
                    <div class="min-w-full mx-auto flex items-center justify-center">
                        <img src="{{ $file->image_url }}" alt="Image de la recette {{ $recipe->title }}"
                            class="mt-5 mb-5 h-[30rem] w-auto object-cover rounded-lg ">
                    </div>
                @endforeach
            </div>


            <!-- Navigation buttons -->
            <button
                class="absolute top-1/2 left-[8vw] transform -translate-y-1/2 p-3 bg-orange-400 bg-opacity-50 rounded-full text-white hover:bg-opacity-75 focus:outline-none"
                onclick="scrollCarousel(-1)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button
                class="absolute top-1/2 right-[8vw] transform -translate-y-1/2 p-3 bg-orange-400 bg-opacity-50 rounded-full text-white hover:bg-opacity-75 focus:outline-none"
                onclick="scrollCarousel(1)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <script>
            let currentIndex = 0;

            function scrollCarousel(direction) {
                const carousel = document.getElementById("carousel");
                const totalSlides = carousel.children.length;
                currentIndex =
                    (currentIndex + direction + totalSlides) % totalSlides;
                carousel.style.transform = `translateX(-${
                currentIndex * 100
            }%)`;
            }
        </script>
    @else
        <img src="{{ $files->first()->image_url }}" alt="Image de la recette
             {{ $recipe->title }}"
            class="mt-5 mb-5 h-[30rem] w-auto object-cover rounded-lg ">


@endif
