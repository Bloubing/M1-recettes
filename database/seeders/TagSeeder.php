<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des 5 tags par défaut
        Tag::create([
            'name' => "Plat",
        ]);

        Tag::create([
            'name' => "Entrée",
        ]);

        Tag::create([
            'name' => "Dessert",
        ]);

        Tag::create([
            'name' => "Boisson",
        ]);

        Tag::create([
            'name' => "Apéritif",
        ]);


        // Création de 20 tags
        Tag::factory()
            ->count(20)
            ->create();

        // Rattachement de tags à toutes les recipes
        foreach (Recipe::all() as $recipe) {
            Tag::find(rand(1, 5))->recipes()->attach($recipe);
            $nb_attach = rand(0, 2);
            for ($i = 0; $i < $nb_attach; $i += 1) {
                Tag::find(rand(6, Tag::count()))
                    ->recipes()->attach($recipe);
            }
        }
    }
}
