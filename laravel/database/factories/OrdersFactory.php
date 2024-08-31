<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'array_of_order_items' => json_encode(array(1,2,3,4,5)),
<<<<<<< HEAD
            'total_price' => $this->faker->randomElement(['12000', '29000', '92000', '54000', '3500']),
=======
            'price' => $this->faker->randomElement(['12000', '29000', '92000', '54000', '3500']),
>>>>>>> 166c846302cf1cc5cf7a6ee2f0ef371477871d64
            'status' => $this->faker->randomElement(['delivered', 'cancelled', 'pending']),
        ];
    }
}
