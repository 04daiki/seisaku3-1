<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image',
            'genre' => 'nullable|string',
        ]);

        $book = new Book();
        $book->name = $request->name;
        $book->genre = $request->genre;
        $book->user_id = Auth::id();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $book->photo = $path;
        }

        // $book.save();
        $book->save();


        return redirect()->route('books.index')->with('success', '正常に本が登録されました。');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image',
            'genre' => 'nullable|string',
        ]);

        $book->name = $request->name;
        $book->genre = $request->genre;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos');
            $book->photo = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}