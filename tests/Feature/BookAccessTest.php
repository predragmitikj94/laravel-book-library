<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_book(): void
    {
        $response = $this->post('/books', [
            'title' => 'Unauthorized Book',
            'author_id' => 1,
            'category_id' => 1,
            'year' => 2024,
            'pages' => 300,
            'image_url' => 'https://example.com/image.jpg',
        ]);

        $response->assertRedirect('/login');
    }
}
