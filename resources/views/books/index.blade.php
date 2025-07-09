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
    <h1>Books List</h1>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <a class="btn btn-sm btn-success" href="{{ route('books.create') }}">Add New Book</a><br><br>

    <table class="table table-striped">

        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Year</th>
                <th>Pages</th>
                <th>Edit</th>
                <th>Show</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->first_name }} {{ $book->author->last_name }}</td>
                    <td>{{ $book->category->title }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->pages }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info">Show</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('books.destroy', $book->id) }}"
                            class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
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
    <!-- SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- SweetAlert delete confirmation logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 

                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, this book and all related comments/notes will be permanently removed.",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit(); 
                            }
                        });
                });
            });
        });
    </script>

</body>

</html>
