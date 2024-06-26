<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// BookController

// 本棚の表示
Route::get('/books', [BookController::class, 'index'])->name('books.index');
// 本の詳細表示
Route::get('/books/{book}/show', [BookController::class, 'show'])->name('books.show');
// 本の新規追加
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
// 本の編集
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
// 本の削除
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
// 本のタイトルで検索
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
// 本のジャンルで検索
Route::get('/books/search-by-genre', [BookController::class, 'searchByGenre'])->name('books.searchByGenre');