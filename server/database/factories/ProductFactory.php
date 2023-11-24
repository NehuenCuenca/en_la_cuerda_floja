<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => fake()->numberBetween($min = 1, $max = 10),
            'name' => fake()->words($nb = 3, $asText = true),
            'description' => fake()->text($maxNbChars = 150),
            'price_cost' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8)
        ];
    }
}
