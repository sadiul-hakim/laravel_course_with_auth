<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $imageable = $this->imageable();
        return [
            'url' => fake()->imageUrl(),
            // 'imageable_id' => $imageable::factory(),
            // 'imageable_type' => $imageable
        ];
    }

    // public function imageable()
    // {
    //     return $this->faker->randomElement([
    //         User::class,
    //         Post::class
    //     ]);
    // }
}
