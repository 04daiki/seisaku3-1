@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- タイトル検索フォーム -->
            <form action="{{ route('books.search') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="title" placeholder="Search by title"
                            value="{{ request('title') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <!-- サイトバー: ジャンル検索フォーム -->
            <h3>Search by Genre</h3>
            <form action="{{ route('books.searchByGenre') }}" method="GET">
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select class="form-control" id="genre" name="genre">
                        <option value="">Select genre</option>
                        <option value="#文芸" {{ request('genre') == '文芸' ? 'selected' : '' }}>文芸</option>
                        <option value="#雑誌" {{ request('genre') == '雑誌' ? 'selected' : '' }}>雑誌</option>
                        <option value="#コミック" {{ request('genre') == 'コミック' ? 'selected' : '' }}>コミック</option>
                        <option value="#文庫" {{ request('genre') == '文庫' ? 'selected' : '' }}>文庫</option>
                        <option value="#絵本・児童書" {{ request('genre') == '絵本・児童書' ? 'selected' : '' }}>絵本・児童書</option>
                        <option value="#実用書" {{ request('genre') == '実用書' ? 'selected' : '' }}>実用書</option>
                        <option value="#学習参考書" {{ request('genre') == '学習参考書' ? 'selected' : '' }}>学習参考書</option>
                        <option value="#専門書" {{ request('genre') == '専門書' ? 'selected' : '' }}>専門書</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="col-md-9">
            <h1>本棚</h1>
            <a href="{{ route('books.index') }}" class="btn btn-primary">一覧へ戻る</a>
            <div class="row mt-4">
                @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->name }}</h5>
                            <p class="card-text">{{ $book->genre }}</p>
                            @if ($book->photo)
                            <img src="{{ asset('storage/' . $book->photo) }}" alt="Book photo" class="img-fluid">
                            @endif
                            <a href="{{ route('books.show', $book) }}" class="btn btn-primary">Show</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection