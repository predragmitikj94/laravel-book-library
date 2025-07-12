<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_book_details(): void
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create book dependencies
        $author = Author::factory()->create();
        $category = Category::factory()->create();

        // Create the book
        $book = Book::factory()->create([
            'author_id' => $author->id,
            'category_id' => $category->id,
        ]);

        // Visit the book details page
        $response = $this->get("/books/{$book->id}");

        // Assert everything is good
        $response->assertStatus(200);
        $response->assertSee($book->title);
    }
}
