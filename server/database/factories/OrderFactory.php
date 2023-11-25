<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween($min = 1, $max = 8),
            'status' => fake()->numberBetween($min = 1, $max = 4),
            'total_price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8)
        ];
    }
}
