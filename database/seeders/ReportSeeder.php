<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 recettes avec plus de 10 signalements
        for ($j = 0; $j < 3; $j += 1) {
            $recipe = Recipe::factory()->create();
            for ($i = 0; $i < 12; $i += 1) {
                $user_id = rand(1, User::count() - 12);
                Report::factory(1)
                    ->create([
                        'user_id' => $user_id,
                        'recipe_id' => $recipe->id
                    ]);
            }
        }
    }
}
