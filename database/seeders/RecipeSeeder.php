<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 recette pour l'admin
        Recipe::factory()
            ->count(1)
            ->for(User::where('name', 'admin')->first())
            ->create();

        // 1 recette pour le modérateur
        Recipe::factory()
            ->count(1)
            ->for(User::where('name', 'moderator')->first())
            ->create();

        // 1 recette pour l'utilisateur sans rôle, Flocon
        Recipe::factory()
            ->for(User::where('name', 'flocon')->first())
            ->create();

        // Création de 200 recipes assignées à un random user
        for ($i = 0; $i < 200; $i += 1) {
            $user = User::inRandomOrder()->first();

            Recipe::factory()
                ->for($user)
                ->create();
        }
    }

}
