@extends('layouts.app')

@section('content')
<div class="container">
    <h1>本棚</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    <div class="row mt-4">
        @foreach ($books as $book)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->name }}</h5>
                    <p class="card-text">{{ $book->genre }}</p>
                    @if ($book->photo)
                    <img src="{{ asset('storage/photos/' . $book->photo) }}" alt="Book photo" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection