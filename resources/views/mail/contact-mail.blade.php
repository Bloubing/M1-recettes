<div>
    <h1>Une personne avec pour adresse mail {{ $contact->email }} vous a contacté via le site</h1>
    <h3> Objet : {{ $contact->objet }}</h3>

    <p>{{ $contact->contenu }}</p>

</div>