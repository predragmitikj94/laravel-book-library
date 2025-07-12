<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Note;
use App\Models\Author;
use App\Models\Category;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_note(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $book = Book::factory()
            ->for(Author::factory())
            ->for(Category::factory())
            ->create();

        $response = $this->post("/books/{$book->id}/notes", [
            'content' => 'This book is super',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('notes', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'content' => 'This book is super',
        ]);
    }

    public function test_user_can_edit_own_note(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->for($user)->create([
            'content' => 'Old content'
        ]);

        $response = $this->put("/notes/{$note->id}", [
            'content' => 'Updated content'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'content' => 'Updated content',
        ]);
    }

    public function test_user_can_delete_own_note(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $note = Note::factory()->for($user)->create();

        $response = $this->delete("/notes/{$note->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }

    public function test_user_cannot_see_others_notes(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $note = Note::factory()->for($userB)->create([
            'content' => 'Secret note'
        ]);

        $this->actingAs($userA);

        $response = $this->get("/notes/{$note->id}/edit");

        $response->assertStatus(403); 
    }
}
