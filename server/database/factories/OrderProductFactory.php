<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity  = fake()->numberBetween($min = 1, $max = 4);
        $productId = fake()->numberBetween($min = 1, $max = 20);

        return [
            'order_id' => fake()->numberBetween($min = 1, $max = 5),
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $quantity * Product::where('id', $productId)->first()->price_cost
        ];
    }
}
