<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker));
        
        return [
            'name' => $this->faker->randomElement([
            $this->faker->numerify($this->faker->vegetableName() . ' #####'),
            $this->faker->numerify($this->faker->meatName() . ' #####'),
            $this->faker->numerify($this->faker->fruitName() . ' #####'),
            $this->faker->numerify($this->faker->dairyName() . ' #####'),
            $this->faker->numerify($this->faker->sauceName() . ' #####'),
            ]),
        ];
    }
}
