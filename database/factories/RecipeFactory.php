<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use FakerRestaurant\Provider\fr_FR\Restaurant;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new Restaurant($this->faker));
        $title = $this->faker->numerify($this->faker->foodName() . ' #####');
        $url = preg_replace('/[^a-zA-Z0-9-]/s', '-', $title);
        while (Recipe::where('url', $url)->exists()) {
            $url .= strval(rand(0, 9));
        }

        return [
            //
            'user_id' => User::factory(),
            'title' => $title,
            'content' => $this->faker->realText(),
            'price' => $this->faker->words($nb = 1, $asText = true),
            'url' => $url,
            'status' => $status = rand(1, 3) > 1 ? 'published' : 'draft'
        ];
    }
}