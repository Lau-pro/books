<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = ['Mystery', 'Horror novels', 'Fantasy novels', 'Non-fiction', 'Fiction', 'Romance novels'];
        $number = collect([1,2,3,4,5,6,7,8,9,0]);
        $isbn =  $number->shuffle()->implode('');
        return [
            'user_id' => 1,
            'title' => fake()->sentence(2),
            'author' => fake()->name(),
            'isbn' => $isbn,
            'genre' => fake()->randomElement($genre),
            'published_date' => fake()->date()
        ];
    }
}
