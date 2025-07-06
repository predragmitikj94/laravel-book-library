<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laravel for Beginners',
                'author_id' => 1,
                'category_id' => 1,
                'year' => 2023,
                'pages' => 250,
                'image_url' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'Effective Management',
                'author_id' => 2,
                'category_id' => 2,
                'year' => 2022,
                'pages' => 300,
                'image_url' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'The Story of Us',
                'author_id' => 3,
                'category_id' => 3,
                'year' => 2021,
                'pages' => 200,
                'image_url' => 'https://via.placeholder.com/150'
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
