@extends('layouts.app')

<!-- このアプリホーム画面 -->
@section('content')
<!-- 更新の成功時のメッセージを表示 -->
@if (session('success'))
<div id="success-message" class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- JavaScriptでメッセージを数秒後に非表示にする -->
<script>
// ページのDOMコンテンツが完全に読み込まれた後に実行されるを追加
document.addEventListener('DOMContentLoaded', function() {
    // ID'success-message'を取得し、successMessageという変数に格納
    var successMessage = document.getElementById('success-message');
    // successMessageが存在する場合3秒後にsuccessMessage要素のdisplayスタイルを'none'にすることで非表示にする
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 3000);
    }
});
</script>
<div class="container">
    <!-- 一覧へ戻るボタン -->
    <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">一覧へ戻る</a>
    <!-- 書籍のタイトルを表示 -->
    <h1>{{ $book->name }}</h1>
    <!-- 書籍の写真を表示 -->
    <!-- 画像表示は未完成です -->
    <img src="{{ asset('storage/' . $book->photo) }}" alt="{{ $book->name }} の写真" class="img-fluid">
    <!-- 書籍のジャンルを表示 -->
    <h3>ジャンル: {{ $book->genre }}</h3>
    <!-- 書籍の登録日を表示 -->
    <p>登録日: {{ $book->created_at }}</p>
    <!-- 書籍の更新日が登録日と異なる場合、更新日も表示 -->
    @if ($book->created_at != $book->updated_at)
    <p>更新日: {{ $book->updated_at }}</p>
    @endif
    <!-- 書籍の情報を編集ページへ遷移するためのボタン -->
    <!-- d-inlineでボタンを横ならび -->
    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary mt-2">編集</a>
    <!-- 書籍の削除フォーム -->
    <!-- d-inlineでボタンを横ならび -->
    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
        <!-- CSRFトークンを生成するためのBladeディレクティブ -->
        @csrf
        <!-- 
        DELETEリクエストを送信するためのメソッド指定
        実際にはPOSTリクエストを行い、そのリクエストに含まれる特殊なフィールドにDELETEリクエストを指定することで、DELETEリクエストをシミュレート
        -->
        @method('DELETE')
        <!-- 削除ボタン -->
        <button type="submit" class="btn btn-danger mt-2">削除</button>
    </form>
</div>
@endsection