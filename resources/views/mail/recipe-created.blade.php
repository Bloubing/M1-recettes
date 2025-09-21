<p>Félicitation, vous avez partagé une nouvelle recette !</p>
<p></p>Titre : {{ $recipe->title }}</p>
<p></p>Contenu : {{ $recipe->content }}</p>
<!-- port non renseigné pour le mode dev, fonctionnera en prod -->
<p></p><a href="{{ env('APP_URL') }}/recipes/{{ $recipe->url }}">CliqueMe !</a></p>