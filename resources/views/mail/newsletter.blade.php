<div>
    <h1>Newsletter hebdomadaire de Recettes !</h1>
    <p>Voici les nouvelles recettes sorties cette semaine</p>
    <ul>
        @foreach ($recipes as $recipe)
            <!-- port non renseigné pour le mode dev, fonctionnera en prod -->
            <li><a href="{{ env('APP_URL') }}/recipes/{{ $recipe->url }}"> {{ $recipe->title }}</a></li>


        @endforeach
    </ul>


</div>