<x-app-layout>
    <h1 class="is-size-3 has-text-weight-bold text-center mb-10">Signalements</h1>

    <div class="space-y-5">
        <a href="/admin/reported-recipes"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-red-300 bg-red-200  transition duration-200 hover:translate-y-[0.125rem]">Recettes
            signalées ({{ $number_of_recipes_reported }})</a>
        <a href="/admin/reported-comments"
            class="flex items-start p-5 border rounded-md shadow-sm hover:bg-red-300 bg-red-200  transition duration-200 hover:translate-y-[0.125rem]">Commentaires
            signalés ({{ $number_of_comments_reported }})</a>
    </div>
    <x-secondary-link-button class="mt-5" href="/admin">Retour</x-secondary-link-button>
</x-app-layout>
