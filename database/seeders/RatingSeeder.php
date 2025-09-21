<?php

namespace Database\Seeders;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Création de 10 ratings pour chaque 10 users
        //On doit s'assurer d'avoir des paires user-recipe uniques
        $users = User::inRandomOrder()->limit(10)->get();
        $recipes = Recipe::all();
        foreach ($users as $user) {

            $userRecipes = $recipes->random(10);

            foreach ($userRecipes as $recipe) {
                Rating::factory(1)
                    ->for($user)
                    ->for($recipe)
                    ->create();

            }

        }




    }
}

