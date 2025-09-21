<x-app-layout>
    @if (session()->has('message'))
        <x-alert :message="session('message')" :failure="false" />
    @endif

    <x-hero />
    <x-stats />
    <x-steps />
    <x-gallery />
    <x-testimonies />
    <x-newsletter />
</x-app-layout>
