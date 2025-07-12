<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pendingComments = Comment::where('is_approved', false)->latest()->get();
        return view('admin.comments.index', compact('pendingComments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Book $book): RedirectResponse
    {

        $validated = $request->validated();


        $existingComment = Comment::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existingComment) {
            return redirect()->back()->with('error', 'You have already commented on this book.');
        }


        Comment::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'content' => $validated['content'],
            'is_approved' => false,
        ]);


        return redirect()->back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function approve(Comment $comment): RedirectResponse
    {
        $comment->is_approved = true;
        $comment->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment approved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
