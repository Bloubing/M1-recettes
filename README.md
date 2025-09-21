# Recettes

Le site est disponible à l'adresse : https://recettes.bloubing.com/

## Installation

### Pré-requis (Debian-like)

-   [Node.js](https://nodejs.org/fr) >= 18.18.2 & [NPM](https://www.npmjs.com/) >= 10.8.2

    ```bash
    apt install npm
    ```

-   [PHP](https://www.php.net/) >= 8.2

    ```bash
    apt install php
    ```

-   [Extensions PHP](https://laravel.com/docs/12.x/deployment#server-requirements)

    ```bash
    apt install php-sqlite3 php-bcmath php-gd php-dom
    ```

-   [Composer](https://getcomposer.org/) >= 2.2

    ```bash
    apt install composer
    ```

-   Disposer d'un compte [GitHub](https://github.com/)

-   Disposer d'un compte [MailTrap.io](https://mailtrap.io/)

### Clone du projet

Se rendre sur le [dépôt GitHub](https://github.com/Bloubing/M1-recettes) du projet et cliquer sur le bouton vert "Code" pour récupérer le lien de clone du dépôt.

Exécuter :

```bash
git clone git@github.com:Bloubing/M1-recettes.git
cd M1-recettes
```

### Installation des paquets

```bash
npm install
composer install
```

### Configuration du projet

```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan vendor:publish --provider="Laravolt\Avatar\ServiceProvider"
```

### Seeding de la base de données

```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

## Configuration externe

### Socialite

-   Aller sur GitHub > Settings > Developer Settings > OAuth Apps.

-   Créer une nouvelle OAuth App

-   Renseigner le [NOM_DOMAINE] pour Homepage URL et "[NOM_DOMAINE]/login/github/callback" pour Authorization callback URL.

-   Copier le Client ID dans le `.env` et le mettre dans `GITHUB_CLIENT_ID`

-   Générer un nouveau Client Secret dans le `.env` et le mettre dans `GITHUB_CLIENT_SECRET`

### MailTrap

-   Compléter le fichier .`env` avec votre `USERNAME` et votre `PASSWORD` MailTrap.

## Exécution (environnement de développement)

-   Exécution de Vite
    ```bash
    npm run dev
    ```
-   Exécution du serveur PHP
    ```bash
    php artisan serve
    ```
-   Déclenchement de l'envoi automatique de la newsletter
    ```bash
    php artisan schedule:run
    ```
-   Exécuter les tâches en queue (e-mails)
    ```bash
    php artisan queue:work
    ```

## Notes

Trois utilisateur·ice·s de test sont créés automatiquement :

-   **Administrateur**
    E-mail : admin@example.test
    Mot de passe : admin
-   **Modérateur**
    E-mail : moderator@example.test
    Mot de passe : moderator
-   **Utilisateur·ice**
    E-mail : flocon@example.test
    Mot de passe : flocon

## Fonctionnalités

### Gestion des recettes

-   CRUD des recettes
-   Enregistrer des brouillons de recettes avant de les publier
-   Mettre des recettes en favori
-   Page listant les recettes publiées par l'utilisateur·ice

### Gestion des commentaires

-   CRUD des commentaires
-   Répondre à un commentaire avec un affichage récursif
-   Modération des commentaires après leur publication
-   Page listant les commentaires publiés par l'utilisateur·ice

### Gestion des tags

-   Création et modification des tags intégrés aux recettes
-   Tags cliquables redirigeant vers une liste des recettes possédant le tag cliqué
-   Page listant l'ensemble des tags existants

### Gestion des ingrédients

-   Création et modification des ingrédients intégrés aux recettes
-   Ingrédients cliquables redirigeant vers une liste des recettes possédant l'ingrédient cliqué
-   Page listant l'ensemble des ingrédients existants
-   Quantité des ingrédients visible sur chaque recette

### Ajout de notes pour les recettes

-   Les utilisateur·ice·s peuvent laisser des notes sur les recettes
-   Note moyenne des recettes
-   Note donnée par un utilisateur·ice apparaît dans le commentaire si l'utilisateur·ice en a publié un

### Administration

-   Ajout de deux rôles d'administration : le modérateur qui peut éditer et l'administrateur qui peut éditer et supprimer n'importe quelle recette, commentaire, etc.
-   Implémentation d'une interface d'administration du site
-   Section sur la page d'administration permettant de voir les recettes et commentaires signalés au moins 10 fois
-   Les administrateurs peuvent modifier les rôles des utilisateur·ice·s

### Enregistrement d'utilisateur·ice·s

-   Nécessité d'être enregistré pour créer des recettes, des commentaires, noter, etc.
-   Vérification de l'e-mail lors de l'inscription
-   Procédure de réinitialisation du mot de passe

### Ajout de fichiers média pour les recettes

-   Ajouter, édition et suppression d'une ou plusieurs images pour les recettes
-   Un carousel apparaît lorsqu'une recette possède plusieurs images

### Intégration graphique poussée

-   Utilisation de Tailwind
-   Utilisation de composants Blade (dont des composants Breeze)
-   Utilisation de la librairie Rombo pour les animations
-   Utilisation d'Alpine.js
-   Site responsive avec un menu burger fonctionnel
-   Messages de feedback de succès et d'échec lors d'actions utilisateur
-   Avatars pour les utilisateur·ice·s

### Intégration d'envoi d'e-mails

-   Envoi d'un e-mail à la publication d'une nouvelle recette
-   Envoi d'un e-mail en cas de réponse à un commentaire
-   Envoi automatique d'une newsletter hebdomadaire contenant les nouvelles recettes de la semaine

### Installer et utiliser des packages

#### Socialite : identification avec GitHub

-   Authentification possible avec GitHub

-   Pour supprimer un compte, le mot de passe n'est pas requis si l'utilisateur·ice utilise Socialite, car l'utilisateur·ice ne dispose pas de mot de passe quand il s'enregistre par ce moyen

### Mise en place et utilisation de Livewire avec des composants

-   Utilisation de Livewire pour la barre de recherche
-   Possibilité de rechercher en triant par recettes, tags, ingrédients et utilisateur·ice·s

## Sources

### Général

-   Laravel, Documentation officielle v11.x, https://laravel.com/docs/11.x

-   Laracasts, 30 Days To Learn Laravel, https://laracasts.com/series/30-days-to-learn-laravel-11

### Front-end

-   Flowbite, Alerts, https://flowbite.com/docs/components/alerts/
-   Flowbite, Hamburger Menu, https://flowbite.com/docs/components/navbar/
-   Font Awesome, Utensils Logo, https://fontawesome.com/v5/icons/utensils?s=solid
-   Font Awesome, Icons, https://fontawesome.com/icons
-   GitHub, GitHub Logo, https://github.com/logos
-   Laravolt/avatar https://github.com/laravolt/avatar
-   Mamba UI, Hero, https://mambaui.com/components/hero
-   Mamba UI, Table, https://mambaui.com/components/table
-   Mamba UI, Stats, https://mambaui.com/components/stats,
-   Mamba UI, Steps, https://mambaui.com/components/steps
-   Marmiton, https://www.marmiton.org/
-   Pines UI, Dropdown Menu, https://devdojo.com/pines/docs/dropdown-menu
-   Pines UI, Modal, https://devdojo.com/pines/docs/modal
-   Pines UI, Radio Group, https://devdojo.com/pines/docs/radio-group
-   Pines UI, Rating, https://devdojo.com/pines/docs/rating
-   Pines UI, Testimonials, https://devdojo.com/pines/marketing/testimonials
-   Pines UI, Textarea (auto-resize),
    https://devdojo.com/pines/docs/textarea-auto-resize
-   Pines UI, Text Animation, https://devdojo.com/pines/docs/text-animation
-   Rombo, Animations, https://rombo.co/tailwind/
-   StackOverflow, Counter, https://stackoverflow.com/questions/65344277/how-do-i-create-an-animated-number-counter-using-alpine-js
-   Tailwind Plus, Newsletter, https://tailwindcss.com/plus/ui-blocks/marketing/sections/newsletter-sections
-   Tailwind Flex, Carousel, https://tailwindflex.com/@tobias/nice-and-simple-carousel
-   Tailwind Flex, Bento Gallery, https://tailwindflex.com/@maximus/categories

### Socialite

-   Akili School, Laravel Socialite : Authentification OAuth avec Google, Facebook et Github (Social login), https://akilischool.com/cours/laravel-socialite-connexion-inscription-avec-google-facebook-github-linkedin-social-login

### Livewire

-   Livewire, Documentation officielle, https://livewire.laravel.com

-   Laracasts, Livewire 3 From Scratch, https://laracasts.com/series/livewire-3-from-scratch

### Divers

-   StackOverflow, https://stackoverflow.com/
-   Forums de Laracasts, https://laracasts.com
