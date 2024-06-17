<!-- 
    制作実習II 第1期プログラム
    @author 0J01021重山大輝
-->

@extends('layouts.app')

<!-- このアプリホーム画面 -->
@section('content')
<!-- 登録・削除の成功時のメッセージを表示 -->
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
<!-- 内容をcontainerクラスで囲んでbootstrapで幅を制御 -->
<div class="container">
    <!-- 行を作成して内部のカラムを並べる -->
    <div class="row">
        <!-- 幅の設定サイドバーは画面の3/12 -->
        <div class="col-md-3">
            <h3>検索</h3>
            <!-- サイトバー: タイトル検索フォーム -->
            <!-- GETメソッドでbooks.searchのルートにリクエストを送信 -->
            <form action="{{ route('books.search') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <!-- 均等幅を設定 -->
                    <div class="col">
                        <input type="text" class="form-control" name="title" placeholder="タイトルで検索"
                            value="{{ request('title') }}">
                    </div>
                    <div class="col">
                        <!-- 検索ボタン 検索結果画面に遷移する -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- サイトバー: ジャンル検索フォーム -->
            <!-- GETメソッドでbooks.searchByGenreのルートにリクエストを送信 -->
            <form action="{{ route('books.searchByGenre') }}" method="GET">
                <div class="form-group">
                    <select class="form-control" id="genre" name="genre">
                        <option value="">ジャンルで検索</option>
                        <!-- valueで値の設定
                        request('genre')でgenreのパラメーターの値を取得
                        == '文芸'でその値が文芸かを判定
                        ? 'selected' : ''は前記の判定がtrueだとoptionタグに'selected'と属性を、falseだと'空白'を追加
                        -->
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
                <!-- 検索ボタン 検索結果画面に遷移する -->
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </form>
        </div>
        <!-- サイドバーとメインコンテンツを分ける線を追加 幅は画面の1/12 -->
        <div class="col-md-1 d-none d-md-block" style="border-left: 1px solid #ccc;"></div>
        <!-- メインコンテンツ 本棚を表示 幅は画面の8/12 -->
        <div class="col-md-8">
            <h1>本棚</h1>
            <!-- 本の新規追加ボタン -->
            <a href="{{ route('books.create') }}" class="btn btn-primary">新規追加</a>

            <div class="row mt-4">
                <!-- 本の一覧をループで表示する -->
                <!-- コントローラーから渡されたcompact('books')=下記の$booksを使用しレコード一つずつを$bookに入れていく -->
                @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <!-- Bootstrapのカード形式 -->
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
                            <img src="{{ asset('storage/images/' . $book->photo) }}" alt="Book photo" class="img-fluid">
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