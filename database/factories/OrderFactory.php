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
            'number' => fake()->numberBetween(20, 150),
            'total_amount' => fake()->randomFloat(2, 100, 1000),
            'date' => fake()->dateTimeBetween('-8 weeks', '-1 week'),
            'status' => fake()->boolean()
        ];
    }
}
