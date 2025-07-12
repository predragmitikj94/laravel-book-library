<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;

class BookCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_book(): void
    {
        // Arrange
        $user = User::factory()->create();
        $author = Author::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user);

        // Act
        $response = $this->post('/books', [
            'title' => 'Test Book',
            'author_id' => $author->id,
            'category_id' => $category->id,
            'year' => 2024,
            'pages' => 123,
            'image_url' => 'https://example.com/image.jpg',
        ]);

        // Assert
        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'year' => 2024,
        ]);
    }
}
