<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'total_items' => fake()->numberBetween(1, 9),
            'created_at' => fake()->dateTimeBetween('-8 weeks', '-1 week'),
            'updated_at' => fake()->dateTimeBetween('-8 weeks', '-1 week'),
            'status' => fake()->boolean()
        ];
    }
}
