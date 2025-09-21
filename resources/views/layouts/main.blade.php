<!DOCTYPE html>
<html lang="fr">


<head>
    <title>Recettes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>


<body x-data x-on:click="$dispatch('clearSearchResults')">
    <div class="">

        @include('layouts.navigation')

        <section class="section">
            @yield('content')
        </section>
    </div>
    <x-footer />
    @livewireScripts
    <script data-navigate-once></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>


</html>
