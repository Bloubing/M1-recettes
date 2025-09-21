<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Création des ingrédients
        Ingredient::factory()
            ->count(20)
            ->create();

        //Rattachement d'ingrédients à des recipes 30 fois       
        foreach (Recipe::all() as $recipe) {                                         
            $servings = rand(2, 10);

            $nb_attach = rand(2, 5);
            $ingredients_ids = [];
            for ($j = 0; $j < $nb_attach; $j++) { // Attach 2 to 5 ingredients per recipe
                $ingredient_id = rand(1, Ingredient::count());
                while (in_array($ingredient_id, $ingredients_ids)) {
                    $ingredient_id = rand(1, Ingredient::count());
                }
                $ingredients_ids[] = $ingredient_id;
                $recipe->ingredients()->attach(Ingredient::find($ingredient_id), [
                    'amount' => rand(1, 10),
                    'unit' => fake()->randomElement(['kg', 'g', 'l', 'ml', 'cac', 'cas']),
                    'servings' => $servings, //même nombre de portions pour tous les ingrédients de cette recette
                ]);
            }
        }
    }
}
