<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'desc' => $this->faker->sentence(),
            'color' => $this->faker->colorName(),
            'stock' => $this->faker->randomElement(['unavailable', 'available']),
            'price' => $this->faker->numberBetween(1000, 999999),
            'tag' => $this->faker->randomElement(['ankara', 'lace', 'senator', 'shoe', 'suits', 'etibo', 'cashmire', 'hats']),
        ];
    }
}
