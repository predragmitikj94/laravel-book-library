<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'biography' => 'John Doe is a writer with over 20 years of experience in technology.'],
            ['first_name' => 'Jane', 'last_name' => 'Smith', 'biography' => 'Jane Smith is a bestselling author in management and leadership.'],
            ['first_name' => 'Alice', 'last_name' => 'Johnson', 'biography' => 'Alice Johnson writes fiction novels that explore human relationships.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
