<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $book->title }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded shadow">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <h3>Leave a Comment</h3>

                    @auth
                        <form action="{{ route('comments.store', $book->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="content">Your Comment:</label>
                                <textarea name="content" id="content" rows="4" class="form-control" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                        </form>
                    @else
                        <p>Please <a href="{{ route('login') }}">log in</a> to leave a comment.</p>
                    @endauth

                    <div class="container mt-4">
                        <h3>Approved Comments:</h3>

                        @if ($comments->count())
                            @foreach ($comments as $comment)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p>{{ $comment->content }}</p>
                                        <small class="text-muted">By: {{ $comment->user->name }} on
                                            {{ $comment->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No comments yet for this book.</p>
                        @endif
                    </div>

                    <div class="container mt-4">
                        <h3>Your Private Notes:</h3>

                        @forelse($book->notes()->where('user_id', auth()->id())->latest()->get() as $note)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p>{{ $note->content }}</p>
                                    <small class="text-muted">Created:
                                        {{ $note->created_at->format('M d, Y') }}</small>
                                    <div class="mt-2">
                                        <a href="{{ route('notes.edit', $note->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>You have no notes for this book yet.</p>
                        @endforelse
                        <br><br>
                    </div>



                    <h4>Add a New Note Bellow</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('notes.store', $book->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="content">Your Note:</label>
                            <textarea name="content" id="content" rows="3" class="form-control" required>{{ old('content') }}</textarea>
                            @error('content')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Add Note</button>

                    </form>
                    <br>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Book List</a>



                </div>
            </div>
        </div>
        
    </x-app-layout>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
