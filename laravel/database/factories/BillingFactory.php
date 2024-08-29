<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */
class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 10),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'closest_landmark' => $this->faker->streetAddress(),
            'phone_number' => $this->faker->phoneNumber(),
            'delivery_type' => $this->faker->randomElement(['door_delivery', 'pickup']),
        ];
    }
}
