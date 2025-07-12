<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated();

        Note::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'content' => $validated['content'],
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Note added successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
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
    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validated();

        $note->update([
            'content' => $validated['content'],
        ]);

        return redirect()->route('books.show', $note->book_id)->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully.');
    }
}
