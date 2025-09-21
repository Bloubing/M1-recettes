<x-app-layout>

    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Administration du site</h1>

    <div class="space-y-5">
        <a href="/admin/recipes"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-orange-50  transition duration-200 hover:translate-y-[0.125rem]">Recettes</a>
        <a href="/admin/users"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-orange-50  transition duration-200 hover:translate-y-[0.125rem]">Utilisateur·ice·s</a>
        <a href="/admin/comments"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-orange-50  transition duration-200 hover:translate-y-[0.125rem]">Commentaires</a>
        <a href="/admin/reported"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-red-300 bg-red-200 transition duration-200 hover:translate-y-[0.125rem]">Signalements
            ({{ $number_reports }})</a>
    </div>

    <x-secondary-link-button class="mt-5" href="/">Retour</x-secondary-link-button>

</x-app-layout>
