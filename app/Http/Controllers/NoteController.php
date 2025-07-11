<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        Note::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'content' => $validated['content'],
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Note added successfully.');
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
    public function edit(Note $note)
    {
        // Ensure only the note's owner can edit
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);

        $note->update([
            'content' => $validated['content'],
        ]);

        return redirect()->route('books.show', $note->book_id)->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully.');
    }
}
