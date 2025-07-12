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

class AdminCommentTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => true,
        ]);
    }

    public function test_admin_can_view_unapproved_comments(): void
    {
        $comment = Comment::factory()->create(['is_approved' => false]);

        $this->actingAs($this->admin);
        $response = $this->get('/admin/comments');

        $response->assertStatus(200);
        $response->assertSee($comment->content);
    }

    public function test_admin_can_approve_a_comment(): void
    {
        $comment = Comment::factory()->create(['is_approved' => false]);

        $this->actingAs($this->admin);
        $response = $this->patch("/admin/comments/{$comment->id}/approve");

        $response->assertRedirect('/admin/comments');

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'is_approved' => true,
        ]);
    }

    public function test_admin_can_delete_a_comment(): void
    {
        $comment = Comment::factory()->create(['is_approved' => false]);

        $this->actingAs($this->admin);
        $response = $this->delete("/admin/comments/{$comment->id}");

        $response->assertRedirect('/admin/comments');

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}