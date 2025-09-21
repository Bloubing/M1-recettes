<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use \App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 comments de l'admin pour la première recette
        for ($i = 1; $i < 4; $i += 1) {
            Comment::factory()
                ->count(1)
                ->for(User::find(1))
                ->for(Recipe::find(1))
                ->create();
        }

        //Création de 40 commentaires assignées à random user et une random recipe avec 1/5 réponses chacuns
        for ($i = 0; $i < 40; $i += 1) {
            $recipe = Recipe::find(rand(1, Recipe::count()));
            Comment::factory()
                ->count(1)
                ->for(User::find(id: rand(1, User::count())))
                ->for($recipe)
                ->has(Comment::factory()->count(rand(1, 5))->for($recipe), 'children')
                ->create();

        }
    }
}
