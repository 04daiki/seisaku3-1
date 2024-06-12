@extends('layouts.app')
<!-- 検索結果画面 -->
@section('content')
<!-- コメントのBootstrapのクラスにや同じ内容についてはindex.blade.php参照 -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- サイトバー: タイトル検索フォーム -->
            <h3>ジャンルで検索</h3>
            <form action="{{ route('books.search') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="title" placeholder="タイトルで検索"
                            value="{{ request('title') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                </div>
            </form>
            <!-- サイトバー: ジャンル検索フォーム -->
            <form action="{{ route('books.searchByGenre') }}" method="GET">
                <div class="form-group">
                    <label for="genre">ジャンル</label>
                    <select class="form-control" id="genre" name="genre">
                        <option value="">ジャンルで検索</option>
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
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
        <div class="col-md-1 d-none d-md-block" style="border-left: 1px solid #ccc;"></div>
        <div class="col-md-8">
            <h1>本棚</h1>
            <!-- 一覧へ戻るボタン -->
            <a href="{{ route('books.index') }}" class="btn btn-secondary">一覧へ戻る</a>
            <div class="row mt-4">
                <!-- 本の一覧をループで表示する -->
                <!-- コントローラーから渡されたcompact('books')=下記の$booksを使用しレコード一つずつを$bookに入れていく -->
                @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- 表示内容 -->
                            <!-- タイトル  40文字以上は...になり詳細ページで全部表示する -->
                            <h5 class="card-title">{{ mb_strimwidth($book->name, 0, 40, '...') }}</h5>
                            <!-- ジャンルの表示 -->
                            <p class="card-text">{{ $book->genre }}</p>
                            <!-- 画像を登録していれば画像も表示 -->
                            <!-- 画像表示は未完成です -->
                            @if ($book->photo)
                            <img src="{{ asset('storage/' . $book->photo) }}" alt="Book photo" class="img-fluid">
                            @endif
                            <!-- 特定の本の詳細画面を表示するためのボタン -->
                            <a href="{{ route('books.show', $book) }}" class="btn btn-primary">詳細</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection