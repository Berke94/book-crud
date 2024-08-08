<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
</head>
<body>
<h1>Book List</h1>
<ul>
    @foreach ($books as $book)
        <li>
            <strong>{{ $book->book_name }}</strong> by {{ $book->author }} <br>
            ISBN: {{ $book->isbn_number }} <br>
            {{ $book->description }} <br>
            Pages: {{ $book->number_of_pages }}
        </li>
    @endforeach
</ul>
</body>
</html>
