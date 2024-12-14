<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class BlogFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => User::where('role_id', 1)->inRandomOrder()->first()->id ?? User::factory(), // Assign random or create user
            'status' => $this->faker->randomElement(['draft', 'published']),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'meta_keywords' => json_encode($this->faker->words(5)), // Example: ["keyword1", "keyword2"]
            'tags' => json_encode($this->faker->words(3)), // Example: ["tag1", "tag2"]
            'categories' => json_encode($this->faker->words(2)), // Example: ["category1", "category2"]
            'images' => json_encode([
                'https://via.placeholder.com/300x200.png?text=Image+1',
                'https://via.placeholder.com/300x200.png?text=Image+2',
                'https://via.placeholder.com/300x200.png?text=Image+3',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
