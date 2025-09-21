<div class="relative isolate overflow-hidden   sm:py-24 lg:py-32  rounded-3xl">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
            <div class="max-w-xl lg:max-w-lg">
                <h2 class="text-3xl sm:text-4xl font-semibold tracking-tight intersect:motion-preset-fade-lg ">
                    Abonnez-vous à
                    notre
                    newsletter</h2>
                <p class="mt-4 text-lg ">Une newsletter faite par des amateurs de cuisine, pour des amateurs de
                    cuisine.
                </p>
                <div class="mt-6 flex max-w-md gap-x-4">
                    <form class="flex-col sm:flex-row flex space-x-2 space-y-2" method="post" action="/newsletter">
                        @csrf
                        @method('patch')
                        <label for="email-address" class="sr-only">Adresse e-mail</label>
                        <input id="email-address" name="email" type="email" autocomplete="email"
                            value="{{ old('email') }}" required
                            class=" border border-grey-500 shadow-sm focus:border-orange-300 focus:ring-orange-500
                            min-w-0 flex-auto rounded-md px-3.5 py-2 text-base outline-1 -outline-offset-1
                            outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2
                            sm:text-sm/6 "
                            placeholder=" Entrez votre e-mail" />
                        @error('email')
                            <x-input-error :messages="$message" />
                        @enderror
                        <x-primary-button type="submit"
                            class="flex-none rounded-md bg-orange-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-orange-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500 intersect:motion-preset-shake motion-delay-500">S'abonner</x-primary-button>
                    </form>
                </div>
            </div>
            <dl class="grid bg-orange-50 p-5 rounded-3xl grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
                <div class="flex flex-col items-start ">
                    <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                        <svg class="size-6 " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                    </div>
                    <dt class="mt-4 text-base font-semibold ">Articles hebdomadaires</dt>
                    <dd class="mt-2 text-base/7 ">Chaque semaine, recevez une nouvelle recette plus délicieuse que
                        la
                        précédente.</dd>
                </div>
                <div class="flex flex-col items-start">
                    <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                        <svg class="size-6 " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                        </svg>
                    </div>
                    <dt class="mt-4 text-base font-semibold ">Pas de spam</dt>
                    <dd class="mt-2 text-base/7 ">Promis, nous ne spammerons pas votre boîte mail. Qualité garantie
                        !
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="absolute top-0 left-1/2 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
        <div class="aspect-1155/678 w-[72.1875rem] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>
</div>
