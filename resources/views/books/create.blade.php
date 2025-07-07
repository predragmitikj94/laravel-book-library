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
    <h1 class="mb-4">Add New Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Author:</label>
            <select name="author_id" class="form-control" required>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                @endforeach
            </select>
            @error('author_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Category:</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Year:</label>
            <input type="number" name="year" class="form-control" required>
            @error('year')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Pages:</label>
            <input type="number" name="pages" class="form-control" required>
            @error('pages')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Image URL:</label>
            <input type="text" name="image_url" class="form-control" required>
            @error('image_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Add Book</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Book List</a>
    </form>
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
