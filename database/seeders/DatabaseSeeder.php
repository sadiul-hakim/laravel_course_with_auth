<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Passport;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Database\Factories\OrderFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::factory(5)
        //     ->has(Passport::factory())
        //     ->has(Post::factory(5))
        //     ->create();
        // User::factory(5)
        //     ->has(Passport::factory())
        //     ->has(Post::factory())
        //     ->has(Order::factory(5)->has(Invoice::factory()))
        //     ->create();
        $roles = Role::factory(5)->create();
        User::factory(5)
            ->has(Passport::factory())
            ->has(Post::factory(2)->has(Image::factory()))
            ->has(Order::factory(5)->has(Invoice::factory()))
            ->has(Image::factory())
            ->create()
            ->each(function ($user) {
                $user->roles()->attach(rand(1, 2));
                $user->roles()->attach(rand(3, 5));
            });
    }
}
