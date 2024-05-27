<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // 本棚の表示
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->get();
        return view('books.index', compact('books'));
    }

    // 本の詳細表示
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // 本の新規追加
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

    // 本の編集
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

        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully');
    }

    // 本の削除
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}