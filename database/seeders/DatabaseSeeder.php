<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création des rôles fixes admin et moderator
        $this->call([RoleSeeder::class]);

        // Création des users
        $this->call([UserSeeder::class]);

        // Création des recettes
        $this->call([RecipeSeeder::class]);

        // Création des commentaires
        $this->call([CommentSeeder::class]);

        // Création des ingrédients et rattachement aux recettes
        $this->call([IngredientSeeder::class]);

        // Création des notes et rattachement aux users et recettes
        $this->call([RatingSeeder::class]);

        // Création des signalements de recettes
        $this->call([ReportSeeder::class]);

        // Création des signalements de commentaires
        $this->call([ReportCommentSeeder::class]);

        // Création des tags et rattachement aux recettes
        $this->call([TagSeeder::class]);

    }
}
