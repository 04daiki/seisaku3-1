@extends('layouts.app')

@section('content')
<div class="container">
    <h1>更新ページ</h1>


    <!-- 一覧へ戻るボタン -->
    <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">一覧へ戻る</a>
    <!-- 書籍の追加フォーム -->
    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        <!-- CSRFトークンを生成するためのBladeディレクティブ -->
        @csrf
        <!-- フォームのメソッドをPUTに設定 -->
        @method('PUT')
        <!-- 本の名前(編集前の情報を初期値として与える) -->
        <div class="form-group">
            <label for="name">本の名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $book->name }}" required>
        </div>
        <!-- 本の写真 -->
        <!-- 写真の登録はできるが画像表示は未完成です -->
        <div class="form-group">
            <label for="photo">本の写真</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <!-- 本の種類 -->
        <div class="form-group">
            <label for="genre">本のジャンル</label>
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
        <!-- 本の情報を更新するためのボタン -->
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection