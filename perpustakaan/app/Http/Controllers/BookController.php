<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'author' => 'required|string|max:255',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
        ]);

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|string|max:13|unique:books,isbn,' . $book->id,
            'author' => 'sometimes|required|string|max:255',
            'published_year' => 'sometimes|required|digits:4|integer|min:1900|max:' . (date('Y')),
        ]);

        $book->update($request->all());
        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}

