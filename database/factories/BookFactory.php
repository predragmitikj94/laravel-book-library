<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'year' => $this->faker->year(),
            'pages' => $this->faker->numberBetween(50, 1000),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
