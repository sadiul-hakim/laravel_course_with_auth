<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-3 years', '-1 week');
        return [
            'title' => fake()->sentence(10),
            'content' => fake()->paragraph(15),
            'created_at' => $date,
            'updated_at' => $date,
            'views' => $this->faker->numberBetween(0, 100),
            'likes' => $this->faker->numberBetween(0, 20),
            'metadata' => ['author' => 'Hakim', 'tags' => ['laravel', 'php 8']]
        ];
    }
}
