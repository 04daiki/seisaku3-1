@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <!-- Back to Book List Button -->
    <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back to Book List</a>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- 本の名前 -->
        <div class="form-group">
            <label for="name">Book Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <!-- 本の写真 -->
        <div class="form-group">
            <label for="photo">Book Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <!-- 本の種類 -->
        <div class="form-group">
            <label for="genre">Book Genre</label>
            <select class="form-select" id="genre" name="genre" aria-label="Default select example">
                <option value="" selected>本の種類を選択してください</option>
                <option value="#文芸">文芸</option>
                <option value="#雑誌">雑誌</option>
                <option value="#コミック">コミック</option>
                <option value="#文庫">文庫</option>
                <option value="#絵本・児童書">絵本・児童書</option>
                <option value="#実用書">実用書</option>
                <option value="#学習参考書">学習参考書</option>
                <option value="#専門書">専門書</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
</div>
@endsection