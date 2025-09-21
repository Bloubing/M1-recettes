<div>
    <p>Une personne a répondu à votre commentaire sur la recette {{ $comment->recipe->title }}</p>
    <!-- port non renseigné pour le mode dev, fonctionnera en prod -->
    <p>Vous pouvez y accéder en cliquant sur <a href="{{ env('APP_URL') }}/recipes/{{ $comment->recipe->url }}"> ce lien
    </p>
</div>