<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Technology', 'Management', 'Fiction', 'Non-fiction', 'Science', 'Biography'];

         foreach ($categories as $category) {
          Category::create([
            'title' => $category,
        ]);
    }
    }
}
