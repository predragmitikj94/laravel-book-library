<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Author;
use App\Models\Category;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_a_comment_for_a_book(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $book = Book::factory()
            ->for(Author::factory())
            ->for(Category::factory())
            ->create();

        $response = $this->post("/books/{$book->id}/comments", [
            'content' => 'This is my opinion on the book.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'content' => 'This is my opinion on the book.',
            'is_approved' => false,
        ]);
    }

    public function test_user_cannot_comment_more_than_once_per_book(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $book = Book::factory()
            ->for(Author::factory())
            ->for(Category::factory())
            ->create();

        // First comment
        Comment::factory()->create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'content' => 'First comment',
            'is_approved' => false,
        ]);

        // Attempt second comment
        $response = $this->post("/books/{$book->id}/comments", [
            'content' => 'Second comment attempt',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'You have already commented on this book.');
    }

    public function test_comment_is_not_visible_until_approved(): void
    {
        $comment = Comment::factory()->create([
            'is_approved' => false,
            'content' => 'Hidden comment',
        ]);

        $response = $this->get("/books/{$comment->book_id}");

        $response->assertDontSee('Hidden comment');
    }
}