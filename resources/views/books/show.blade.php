@extends('layouts.app')

@section('content')
<!-- Back to Book List Button -->
<a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">Back to Book List</a>
<div class="container">
    <h1>{{ $book->name }}</h1>
    <img src="{{ asset('storage/app/' . $book->photo) }}" alt="{{ $book->name }} Photo" class="img-fluid">
    <p>ジャンル: {{ $book->genre }}</p>
    <p>登録日: {{ $book->created_at }}</p>
    @if ($book->created_at != $book->updated_at)
    <p>更新日: {{ $book->updated_at }}</p>
    @endif
    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary mt-2">編集</a>
    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-2">削除</button>
    </form>
</div>
@endsection