@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                <option value="文芸">文芸</option>
                <option value="エッセイ">エッセイ</option>
                <option value="古文">古文</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection