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
        // ログインしているユーザーのIDにと一致するユーザーDIの書籍を取得するクエリを作成
        $books = Book::where('user_id', Auth::id())->get();
        // 取得した書籍を'books.index'ビューに渡して表示
        return view('books.index', compact('books'));
    }

    // 本の詳細表示
    // ルーティングで書籍IDに対応するレコードを指定
    public function show(Book $book)
    {   
        // 詳細ページ（$book）にアクセスする権限があるかどうかをポリシーを呼び出してチェック
        $this->authorize('show', $book);
        // 'books.show' ビューに結果を渡して表示
        return view('books.show', compact('book'));
    }

    // 本の新規追加
    public function create()
    {
        // 'books.create'ビューを表示
        return view('books.create');
    }

    public function store(Request $request)
    {   
        // バリデーションのルールの設定
        $request->validate([
            'name' => 'required',   // 書籍名=必須
            'photo' => 'nullable|image',    // 写真=画像ファイルであること・任意
            'genre' => 'nullable|string',   // ジャンル=文字列・任意
        ]);

        // Bookモデルの新しいインスタンスを生成
        $book = new Book();
        // リクエストから受け取った本の名前を設定
        $book->name = $request->name;
        // リクエストから受け取ったジャンルを設定
        $book->genre = $request->genre;
        // ユーザーIDを設定（ログインしているユーザーのID）
        $book->user_id = Auth::id();

        // フォームから新しい写真がアップロードされた場合
        if ($request->hasFile('photo')) {
            // アップロードされた写真を保存し、DBに画像パスを書籍の写真として設定する
            $path = $request->file('photo')->store('public/images');
            $book->photo = $path;
        }

        // DBに上記の書籍情報で保存
        $book->save();
        // 書籍一覧ページにリダイレクトし、登録成功メッセージを表示
        return redirect()->route('books.index')->with('success', '正常に本が登録されました');
    }

    // 本の編集
    // ルーティングで書籍IDに対応するレコードを指定
    public function edit(Book $book)
    {   
        // 更新ページにアクセスする権限があるかどうかをポリシーを呼び出してチェック
        $this->authorize('update', $book);
        // 'books.edit'ビューに情報を渡して表示
        return view('books.edit', compact('book'));
    }
    
    public function update(Request $request, Book $book)
    {
        // 更新アクションの権限があるかどうかをポリシーを呼び出してチェック
        $this->authorize('update', $book);

        // バリデーションのルールの設定
        $request->validate([
            'name' => 'required',   // 書籍名=必須
            'photo' => 'nullable|image',    // 写真=画像ファイルであること・任意
            'genre' => 'nullable|string',   // ジャンル=文字列・任意
        ]);

        // フォームから受け取った書籍の情報を更新
        $book->name = $request->name;
        $book->genre = $request->genre;

        // フォームから新しい写真がアップロードされた場合
        if ($request->hasFile('photo')) {
            // アップロードされた写真を保存し、DBに画像パスを書籍の写真として設定する
            $path = $request->file('photo')->store('photos');
            $book->photo = $path;
        }
        // DBに上記の書籍情報で更新
        $book->save();
        // show（更新した書籍の詳細画面）にリダイレクトし、更新成功メッセージを表示
        return redirect()->route('books.show', $book)->with('success', '本が正常に更新されました');
    }

    // 本の削除
    // ルーティングで書籍IDに対応するレコードを指定
    public function destroy(Book $book)
    {
        // 削除アクションの権限があるかどうかをポリシーを呼び出してチェック
        $this->authorize('delete', $book);
        // 指定されたレコードをデータベースから削除
        $book->delete();
        // indexにリダイレクトし削除成功メッセージを表示
        return redirect()->route('books.index')->with('success', '正常に削除されました');
    }

    // 本のタイトルで検索
    public function search(Request $request)
    {
        // Bookモデルのクエリビルダインスタンスをつくる
        $query = Book::query();

        // リクエストにtitleフィールドがあり、その値が空でない場合は、クエリにtitleの値を含むnameのレコードを検索する条件を追加
        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->input('title') . '%');
        }

        // クエリにカラムが認証されたユーザーのIDと一致するレコードを検索する条件を追加(リクエストを送ったユーザー)
        $query->where('user_id', Auth::id());
        // クエリを実行して、結果を$Bookに取得
        $books = $query->get();
        // 'books.search_results'ビューに結果を渡して表示
        return view('books.search_results', compact('books'));
    }
    
    // 本のジャンルで検索
    public function searchByGenre(Request $request)
    {   
        // 現在認証されているユーザーのIDと一致するレコードをBookテーブルから取得し、さらにリクエストから渡されたジャンルと一致するレコードだけという条件を加える
        $books = Book::where('user_id', Auth::id())
            ->where('genre', $request->genre)
            // 結果をデータベースから取得し$booksに入れる
            ->get();

        // 'books.search_results'ビューに結果を渡して表示
        return view('books.search_results', compact('books'));
    }
}