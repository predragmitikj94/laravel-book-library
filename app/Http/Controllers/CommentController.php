<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingComments = Comment::where('is_approved', false)->latest()->get();
        return view('admin.comments.index', compact('pendingComments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);


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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function approve(Comment $comment)
    {
        $comment->is_approved = true;
        $comment->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment approved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
